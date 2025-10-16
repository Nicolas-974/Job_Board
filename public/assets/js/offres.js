document.addEventListener("DOMContentLoaded", () => {
  // Formulaire classique
  document.querySelectorAll('.apply-form').forEach(form => {
    form.addEventListener('submit', function(e) {
      e.preventDefault();
      const formData = new FormData(this);
      const adId = this.dataset.adId;

      fetch('index.php?page=offres', {
        method: 'POST',
        body: formData
      })
      .then(r => r.json())
      .then(data => {
        document.getElementById('message-' + adId).innerHTML =
          `<div class="alert alert-info">${data.message}</div>`;
      });
    });
  });

  // Postuler direct pour user connecté
  document.querySelectorAll('.apply-direct').forEach(btn => {
    btn.addEventListener('click', function() {
      const adId = this.dataset.adId;
      const formData = new FormData();
      formData.append('apply_ad_id', adId);
      formData.append('name', this.dataset.name);
      formData.append('firstname', this.dataset.firstname);
      formData.append('email', this.dataset.email);

      fetch('index.php?page=offres', {
        method: 'POST',
        body: formData
      })
      .then(r => r.json())
      .then(data => {
        document.getElementById('message-' + adId).innerHTML =
          `<div class="alert alert-info">${data.message}</div>`;
      });
    });
  });
});