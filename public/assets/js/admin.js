console.log("✅ admin.js chargé !"); // Vérifie que le fichier est bien exécuté

/**
 * Fonction générique pour gérer l'affichage/masquage d'un formulaire
 * @param {string} btnId - ID du bouton
 * @param {string} formId - ID du formulaire
 * @param {string} listId - ID de la liste
 * @param {string} titleId - ID du titre
 * @param {string} textCreate - Texte du bouton en mode liste
 * @param {string} textBack - Texte du bouton en mode formulaire
 */
function toggleForm(btnId, formId, listId, titleId, textCreate, textBack) {
  const btn = document.getElementById(btnId);
  const form = document.getElementById(formId);
  const list = document.getElementById(listId);
  const title = document.getElementById(titleId);

  // Debug : affichage des éléments trouvés
  console.log("🔍 Init toggleForm:", {
    btnId, formId, listId, titleId,
    btn, form, list, title
  });

  if (btn && form && list && title) {
    btn.addEventListener('click', function (e) {
      e.preventDefault();
      console.log("👉 Bouton cliqué:", btnId);

      // Debug : état actuel du formulaire
      console.log("Avant toggle:", { display: form.style.display });

      const isCreating = form.style.display !== 'none';

      if (!isCreating) {
        form.style.display = 'block';
        list.style.display = 'none';
        title.style.display = 'none';

        btn.textContent = textBack;
        btn.classList.remove('btn-success');
        btn.classList.add('btn-secondary');
      } else {
        form.style.display = 'none';
        list.style.display = 'block';
        title.style.display = 'block';

        btn.textContent = textCreate;
        btn.classList.remove('btn-secondary');
        btn.classList.add('btn-success');
      }

      // Debug : état après toggle
      console.log("Après toggle:", { display: form.style.display });
    });
  } else {
    console.warn("⚠️ toggleForm: un élément est introuvable pour", btnId);
  }
}

const urlParams = new URLSearchParams(window.location.search);
const section = urlParams.get('section');

if (section === 'offers') {
  toggleForm(
    'btnToggleCreate',
    'formCreate',
    'offersList',
    'offersTitle',
    '➕ Créer une nouvelle annonce',
    '← Retour à la liste'
  );
}

if (section === 'users') {
  toggleForm(
    'btnToggleUserCreate',
    'formUserCreate',
    'usersList',
    'usersTitle',
    '➕ Créer un nouvel utilisateur',
    '← Retour à la liste'
  );
}

if (section === 'companies') {
  toggleForm(
    'btnToggleCompaniesCreate',
    'formCompaniesCreate',
    'companiesList',
    'companiesTitle',
    '➕ Ajouter une entreprise',
    '← Retour à la liste'
  );
}

  if (section === 'jobs') {
  toggleForm(
    'btnToggleJobsCreate',
    'formJobCreate',
    'jobsList',
    'jobsTitle',
    '➕ Ajouter une candidature',
    '← Retour à la liste'
  );
}