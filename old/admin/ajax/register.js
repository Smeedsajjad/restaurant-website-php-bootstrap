document.getElementById('singupForm').addEventListener('submit', function (e) {
    e.preventDefault();

    const formData = new FormData(this);

    fetch('../php/register.php', {
        method: 'POST',
        body: formData
    })
        .then(response => response.json())
        .then(data => {
            alert(data.message);
            if (data.success) {
                window.location.href = '../login.php';
            }
        })
        .catch(error => console.error('Error:', error));
});
