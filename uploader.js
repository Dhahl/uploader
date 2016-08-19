/**
 * 
 */
document.getElementById('selectImage').addEventListener('change', handleFileSelect, false);
var reader;
var progress = document.getElementById('percent');
var progress2 = document.getElementById('percent2');
var filesCount;
var percent;
var progresspercent;
var receivedProgressPercent;

function handleFileSelect(evt) {
    progress.style.width = '10%';
    progress.textContent = '';
    var files = evt.target.files; // FileList object
    processFiles(files);
}
function processFiles(files){
    document.getElementById('progress_bar').className = 'loading';
	progress.style.width='0%';
	progress.textContent='...';
	progress2.style.width='0%';
	progress2.textContent='...';
    document.getElementById('progress_bar2').className = 'loading';
	filesCount = files.length;
	percent = 100 / filesCount;
	progressPercent = 0;
	receivedProgressPercent = 0;
	
    for (var i = 0, f; f = files[i]; i++) {
	      // Only process image files.
	      if (!f.type.match('image.*')) {
	    	  alert("file "+ f.name +" ignored - not an image file");
	        continue;
	      }
	      if(f.size > 500*1024) {
	    	  alert("file "+ f.name +" ignored - too large. Max size of upload files is restricted to 500k ");
	    	  continue;
	      }
	      
	      var reader = new FileReader();
	      // Closure to capture the file information.
	      reader.onload = (function(theFile) {
	        return function(e) {
	          	progressPercent += percent; 
	          	fileName = escape(theFile.name);
	        	pc = Math.round(progressPercent) + '%'
            	progress.style.width = pc;
            	progress.textContent = pc;
	            document.getElementById('progress_bar').value = pc;
		        var span  = ['<div class="col-md-1 " id="',fileName,
                     '"><i class="sent fa fa-cog fa-spin" id="spinner_'+fileName+'"></i><img class="thumb" src="', 
                     e.target.result,'" title="', fileName, '"/></div>'].join('');
		        list = document.getElementById('list').innerHTML;
		        document.getElementById('list').innerHTML = list + span;
		        serverSaveFile(e.target.result,theFile.name);
		        };
	      })(f);

	      // Read in the image file as a data URL.
	      reader.readAsDataURL(f);
	    }
}
function serverSaveFile(file,fileName){
		  img = file;
		  img= img.replace(/^data:image\/(png|jpg|jpeg|gif);base64,/, "");
				var request = $.ajax({
					url: loc_root + "serverSaveFile.php",
					data: {name: fileName, file: img},
					type: "POST",			
					dataType: "html"
				});
				request.done(function(msg) {
					receivedProgressPercent += percent;
		        	R_pc = Math.round(receivedProgressPercent) + '%'
	            	progress2.style.width = R_pc;
		            progress2.textContent = R_pc;
		            img1= document.getElementById(msg).innerHTML;
		            
		            div = document.getElementById(msg);
		            div.innerHTML='<a href="images/'+msg+'" target="_blank">'+img1+'</a>';
		            div.className='col-md-1 ';

		            spinnerName='spinner_'+msg;
		            spinner = document.getElementById(spinnerName);
		            spinner.className="saved fa fa-check-square";
				});

				request.fail(function(jqXHR, textStatus) {
					alert( "Request failed: " + textStatus + ' file: ' + fileName );
				});
}
function allowDrop(ev) {
		    ev.preventDefault();
}
function drag(ev) {
		    ev.dataTransfer.setData("text", ev.target.id);
}
function drop(ev) {
		    ev.preventDefault();
		    progress.style.width = '10%';
		    progress.textContent = '';

		    $('div.success').text('');
		    var files = ev.dataTransfer.files;
		    processFiles(files);
		    
}
