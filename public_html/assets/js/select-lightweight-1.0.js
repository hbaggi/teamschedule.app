/*-----------------------------------------
  Select Background
---------------------------------------*/
$(function() {
  const bgType = document.getElementById('bg_type');
  const gradient = document.getElementById('gradient');
  const custom = document.getElementById('custom');
  const image = document.getElementById('image');
  if (custom && image) {
    custom.classList.add('hidden');
    image.classList.add('hidden');
  }
  if (bgType) {
    bgType.addEventListener('change', function() {
      if (bgType.value === 'gradient') {
        gradient.classList.remove('hidden');
        if (custom && image) {
          custom.classList.add('hidden');
          image.classList.add('hidden');
      }
        } else if (bgType.value === 'custom') {
        gradient.classList.add('hidden');
        if (custom && image) {
          custom.classList.remove('hidden');
          image.classList.add('hidden');
      }
        } else if (bgType.value === 'image') {
        gradient.classList.add('hidden');
        if (custom && image) {
          custom.classList.add('hidden');
          image.classList.remove('hidden');
      }
        }
    });
  }
});


$(function() {
  const pixType = document.getElementById('pix_type');
  const pf = document.getElementById('pf');
  const pj = document.getElementById('pj');
  const email = document.getElementById('email');
  const celular = document.getElementById('celular');
  if (pj && email && celular) {
    pj.classList.add('hidden');
    email.classList.add('hidden');
    celular.classList.add('hidden');
  }
  if (pixType) {
    pixType.addEventListener('change', function() {
      if (pixType.value === 'pf') {
        pf.classList.remove('hidden');
        if (pj && email && celular) {
          pj.classList.add('hidden');
          email.classList.add('hidden');
          celular.classList.add('hidden');
      }
        } else if (pixType.value === 'email') {
        pf.classList.add('hidden');
        if (pj && email && celular) {
          pj.classList.add('hidden');
          email.classList.remove('hidden');
          celular.classList.add('hidden');
      }
        } else if (pixType.value === 'celular') {
        pf.classList.add('hidden');
        if (pj && email && celular) {
          pj.classList.add('hidden');
          email.classList.add('hidden');
          celular.classList.remove('hidden');
      }
        } else if (pixType.value === 'pj') {
        pf.classList.add('hidden');
        if (pj && email && celular) {
          pj.classList.remove('hidden');
          email.classList.add('hidden');
          celular.classList.add('hidden');
      }
        }
    });
  }
});