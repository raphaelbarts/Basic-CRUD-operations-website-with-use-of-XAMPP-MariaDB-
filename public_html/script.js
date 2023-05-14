const togglePassword = document.querySelector('#toggle-password');
const password = document.querySelector('#password');

togglePassword.addEventListener('click', function() {
	const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
	password.setAttribute('type', type);
	this.querySelector('i').classList.toggle('fa-eye-slash');
});
