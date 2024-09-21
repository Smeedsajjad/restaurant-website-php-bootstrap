document.getElementById('login-form').addEventListener('submit', function (e) {
    e.preventDefault();
    
    const formData = new FormData(this);
    
    fetch('../php/login.php', {
        method: 'POST',
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        alert(data.message);
        if (data.success) {
            window.location.href = '../index.php';
        }
    })
    .catch(error => console.error('Error:', error));
});
