
setTimeout(function() {
    var successContainer = document.getElementById('successContainer');
    if (successContainer) {
        successContainer.style.display = 'none';
    }
}, 2000);

setTimeout(function() {
    var errorContainer = document.getElementById('errorContainer');
    if (errorContainer) {
        errorContainer.style.display = 'none';
    }
}, 2000);

