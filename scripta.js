document.getElementById('uploadForm').addEventListener('submit', function(event) {
    event.preventDefault();
    
    var formData = new FormData();
    formData.append('image', document.getElementById('image').files[0]);
    formData.append('file', document.getElementById('file').files[0]);
    formData.append('name', document.getElementById('name').value);
    formData.append('phone', document.getElementById('phone').value);
    3.
    formData.append('address', document.getElementById('address').value);
    formData.append('bread', document.getElementById('bread').value);
    formData.append('milk_per_day', document.getElementById('milk_per_day').value);
    formData.append('amount', document.getElementById('amount').value);
    formData.append('description', document.getElementById('description').value);

    fetch('cwupload.php', {
        method: 'POST',
        body: formData
    })
    .then(response => response.text())
    .then(data => {
        document.getElementById('message').innerHTML = data;
    })
    .catch(error => {
        console.error('Error:', error);
    });
});

