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

(function () {
  const API_URL = "../api/index.php/advertisements"; // adapte si besoin

  const input = document.getElementById('search-input');
  const searchBtn = document.getElementById('search-btn'); // si pas présent, ok
  const clearBtn = document.getElementById('clear-search');
  const cardsContainer = document.querySelector('.row.g-4');
  const paginationNav = document.querySelector('nav[aria-label="Pagination"]');
  const filterSelect = document.getElementById('filterField');

  if (!cardsContainer) return console.error('cardsContainer introuvable (.row.g-4)');

  // sauvegarde état initial
  const initialCardsHTML = cardsContainer.innerHTML;
  const initialPaginationHTML = paginationNav ? paginationNav.innerHTML : '';
  const initialPaginationDisplay = paginationNav ? getComputedStyle(paginationNav).display : '';

  // stockage des annonces
  let allAds = null; // null = pas encore fetché

  function escapeHtml(str) {
    if (str === null || str === undefined) return '';
    return String(str).replace(/&/g,'&amp;').replace(/</g,'&lt;').replace(/>/g,'&gt;').replace(/"/g,'&quot;').replace(/'/g,'&#39;');
  }

  function buildCardHTML(ad) {
    return `
      <div class="col-12 col-md-4">
        <div class="card shadow-sm h-100">
          <div class="card-body">
            <h5 class="card-title">${escapeHtml(ad.title)}</h5>
            <p class="card-text">${escapeHtml((ad.short_description||'').slice(0,200))}${(ad.short_description && ad.short_description.length>200)?'...':''}</p>
            <button class="btn btn-outline-primary mb-2" type="button" data-bs-toggle="collapse" data-bs-target="#details${ad.ad_id}" aria-expanded="false">Voir plus</button>
            <div class="collapse" id="details${ad.ad_id}">
              <ul class="list-group list-group-flush mb-2">
                <li class="list-group-item"><strong>Description :</strong> ${escapeHtml(ad.description)}</li>
                <li class="list-group-item"><strong>Lieu :</strong> ${escapeHtml(ad.location)}</li>
                <li class="list-group-item"><strong>Type de contrat :</strong> ${escapeHtml(ad.contract_type)}</li>
                <li class="list-group-item"><strong>Salaire :</strong> ${escapeHtml(ad.salary)}</li>
                <li class="list-group-item"><strong>Entreprise :</strong> ${escapeHtml(ad.company_name)}</li>
                <li class="list-group-item"><strong>Postée le :</strong> ${escapeHtml(ad.posted_date)}</li>
              </ul>
            </div>
            <button class="btn btn-success">Postuler</button>
          </div>
        </div>
      </div>
    `;
  }

  function showNoResults() {
    cardsContainer.innerHTML = '<div class="col"><div class="alert alert-warning">Aucune offre trouvée.</div></div>';
  }

  // filtre cohérent : compare la valeur du select (title/location/contract_type/all)
  function filterAdsLocal(query) {
    if (!allAds) return [];
    const q = (query || '').trim().toLowerCase();
    const filterVal = (filterSelect && filterSelect.value) ? filterSelect.value : 'all';

    if (!q) return allAds;

    return allAds.filter(ad => {
      const title = (ad.title || '').toLowerCase();
      const location = (ad.location || '').toLowerCase();
      const contract = (ad.contract_type || '').toLowerCase();

      if (filterVal === 'title') {
        return title.includes(q);
      } else if (filterVal === 'location') {
        return location.includes(q);
      } else if (filterVal === 'contract_type') {
        return contract.includes(q);
      } else { // all
        return title.includes(q) || location.includes(q) || contract.includes(q);
      }
    });
  }

  function renderResultsList(list) {
    if (!list || list.length === 0) { showNoResults(); return; }
    cardsContainer.innerHTML = list.map(buildCardHTML).join('');
  }

  function restoreInitialDisplay() {
    cardsContainer.innerHTML = initialCardsHTML;
    if (paginationNav) {
      paginationNav.innerHTML = initialPaginationHTML;
      paginationNav.style.display = initialPaginationDisplay || '';
    }
  }

  // récupère toutes les annonces (une seule fois) puis filtre localement
  function ensureAllAds() {
    if (allAds !== null) return Promise.resolve(allAds);
    return fetch(API_URL)
      .then(r => {
        if (!r.ok) throw new Error('fetch error ' + r.status);
        return r.json();
      })
      .then(json => {
        // ton API retourne { status: "success", data: [...] }
        allAds = json && json.data ? json.data : (json.ads || []);
        return allAds;
      })
      .catch(err => {
        console.error('Erreur fetch API:', err);
        allAds = [];
        return allAds;
      });
  }

  // main search function (debounced)
  function performSearchNow() {
    const q = input.value.trim();
    if (!q) {
      restoreInitialDisplay();
      return;
    }
    ensureAllAds().then(() => {
      const results = filterAdsLocal(q);
      renderResultsList(results);
      if (paginationNav) paginationNav.style.display = 'none';
    });
  }

  function debounce(fn, ms) {
    let t;
    return function (...args) { clearTimeout(t); t = setTimeout(() => fn.apply(this, args), ms); };
  }

  const debouncedPerform = debounce(performSearchNow, 250);

  // événements
  input.addEventListener('input', debouncedPerform);
  // si tu as un bouton recherche:
  if (searchBtn) searchBtn.addEventListener('click', performSearchNow);
  if (clearBtn) clearBtn.addEventListener('click', function () {
    input.value = '';
    if (filterSelect) filterSelect.value = 'all';
    restoreInitialDisplay();
  });
  if (filterSelect) filterSelect.addEventListener('change', function () {
    // relancer la recherche actuelle avec le nouveau filtre
    const q = input.value.trim();
    if (!q) {
      // si champ vide, on ne touche pas à l'affichage initial
      return;
    }
    debouncedPerform();
  });

  // optionnel : si tu veux initialiser allAds en background pour que la première recherche soit plus rapide,
  // décommente la ligne suivante :
  // ensureAllAds();

})();
