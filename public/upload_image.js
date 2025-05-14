
document.addEventListener('DOMContentLoaded', function() {
    const fileInput = document.getElementById('image-upload');
    const dropArea = document.querySelector('label[for="image-upload"]');
    const fileNameDisplay = document.getElementById('file-name');
    
    // Handle click
    dropArea.addEventListener('click', function(e) {
        if (e.target.tagName !== 'INPUT') {
            fileInput.click();
        }
    });
    
    // Handle drag over
    dropArea.addEventListener('dragover', function(e) {
        e.preventDefault();
        dropArea.classList.add('border-blue-500', 'dark:border-blue-500');
    });
    
    // Handle drag leave
    dropArea.addEventListener('dragleave', function() {
        dropArea.classList.remove('border-blue-500', 'dark:border-blue-500');
    });
    
    // Handle drop
    dropArea.addEventListener('drop', function(e) {
        e.preventDefault();
        dropArea.classList.remove('border-blue-500', 'dark:border-blue-500');
        
        if (e.dataTransfer.files.length) {
            fileInput.files = e.dataTransfer.files;
            displayFileName(e.dataTransfer.files[0].name);
        }
    });
    
    // Handle file selection
    fileInput.addEventListener('change', function() {
        if (fileInput.files.length) {
            displayFileName(fileInput.files[0].name);
        }
    });
    
    function displayFileName(name) {
        fileNameDisplay.textContent = 'Selected: ' + name;
        fileNameDisplay.classList.remove('hidden');
    }
});