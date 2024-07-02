	// JS dari Hamburger Navbar
		const hamburger = document.getElementById('hamburger');
		const sidebar = document.getElementById('sidebar');
		const overlay = document.getElementById('overlay');
		const hamIcon = document.querySelector('.ham-icon');
		const closeIcon = document.querySelector('.close-icon');

		hamburger.addEventListener('click', () => {
			sidebar.classList.toggle('active');
			overlay.classList.toggle('active');
			hamIcon.classList.toggle('hidden');
			closeIcon.classList.toggle('hidden');
		});

		overlay.addEventListener('click', () => {
			sidebar.classList.remove('active');
			overlay.classList.remove('active');
			hamIcon.classList.remove('hidden');
			closeIcon.classList.add('hidden');
		});

		// JS dari Hamburger Navbar END