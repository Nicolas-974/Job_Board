<?php 
// Profil centré, pas de colonne blanche
$people_id = intval($_SESSION['user']['people_id'] ?? ($_SESSION['user']['id'] ?? 0));
$firstname = htmlspecialchars($_SESSION['user']['firstname'] ?? '');
$name = htmlspecialchars($_SESSION['user']['name'] ?? '');
$email = htmlspecialchars($_SESSION['user']['email'] ?? '');
$phone = htmlspecialchars($_SESSION['user']['phone'] ?? '');
$address = htmlspecialchars($_SESSION['user']['address'] ?? '');
?>
<!doctype html>
<html lang="fr">
<head>
  <meta charset="utf-8">
  <title>Mon profil — <?= $firstname ?> <?= $name ?></title>
  <meta name="viewport" content="width=device-width,initial-scale=1">

  <!-- Bootstrap + Icons -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
  <link href="../public/css/profil_user.css" rel="stylesheet">
</head>
<body>

  <div class="card-center">
    <div class="card-body">
      <div class="d-flex align-items-center justify-content-between mb-3">
        <div class="d-flex align-items-center gap-3">
          <div class="avatar" id="avatarInitials"><?= strtoupper(($firstname[0] ?? '') . ($name[0] ?? 'U')) ?></div>
          <div>
            <h4 class="mb-0" id="displayName"><?= $firstname ?> <?= $name ?></h4>
            <small class="text-muted" id="displayEmail"><?= $email ?></small>
          </div>
        </div>
        <div><small class="text-muted">Mon profil</small></div>
      </div>

      <!-- Formulaire centré : remplace ton ancien formulaire -->
      <form id="profileForm" class="row g-3 needs-validation" novalidate>
        <input type="hidden" name="people_id" value="<?= $people_id ?>">

        <div class="col-12 col-md-6">
          <label for="nom" class="form-label">Nom</label>
          <input type="text" id="nom" name="name" class="form-control" value="<?= $name ?>" required>
        </div>

        <div class="col-12 col-md-6">
          <label for="prenom" class="form-label">Prénom</label>
          <input type="text" id="prenom" name="firstname" class="form-control" value="<?= $firstname ?>" required>
        </div>

        <div class="col-12 col-md-6">
          <label for="email" class="form-label">Email</label>
          <input type="email" id="email" name="email" class="form-control" value="<?= $email ?>" required>
          <div class="invalid-feedback">Veuillez renseigner un email valide.</div>
        </div>

        <div class="col-12 col-md-6">
          <label for="telephone" class="form-label">Téléphone</label>
          <input type="tel" id="telephone" name="phone" class="form-control" value="<?= $phone ?>">
        </div>

        <div class="col-12 col-md-6">
          <label for="adresse" class="form-label">Adresse</label>
          <input type="text" id="adresse" name="address" class="form-control" value="<?= $address ?>">
        </div>

        <div class="col-12 col-md-6">
          <label for="password" class="form-label">Nouveau mot de passe (laisser vide pour garder l'actuel)</label>
          <input type="password" id="password" name="password" class="form-control" value="">
        </div>

        <div id="alert-placeholder" class="col-12"></div>

        <div class="col-12 d-flex justify-content-end">
          <button id="saveBtn" type="submit" class="btn-save"><i class="bi bi-save me-2"></i><span id="saveTxt">Enregistrer</span></button>
        </div>
      </form>
    </div>
  </div>

  <!-- scripts -->
  <script>
    // Bootstrap validation boilerplate
    (function () {
      'use strict';
      const forms = document.querySelectorAll('.needs-validation');
      Array.from(forms).forEach(function (form) {
        form.addEventListener('submit', function (event) {
          if (!form.checkValidity()) {
            event.preventDefault();
            event.stopPropagation();
          }
          form.classList.add('was-validated');
        }, false);
      });
    })();
  </script>

  <script>
    // Envoi vers ton API comme : PUT http://localhost/Job_Board/api/index.php/people/{id}
    (function () {
      const form = document.getElementById('profileForm');
      const saveBtn = document.getElementById('saveBtn');
      const saveTxt = document.getElementById('saveTxt');
      const alertPlaceholder = document.getElementById('alert-placeholder');
      const cvInput = document.getElementById('cv');
      const displayEmail = document.getElementById('displayEmail');
      const displayName = document.getElementById('displayName');
      const avatarInitials = document.getElementById('avatarInitials');

      function showAlert(type, msg) {
        alertPlaceholder.innerHTML = `
          <div class="alert alert-${type} alert-dismissible fade show" role="alert">
            ${msg}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>`;
      }

      // preview CV filename
      cvInput?.addEventListener('change', (e) => {
        const f = e.target.files[0];
        document.getElementById('cv-preview').textContent = f ? `Fichier : ${f.name} (${Math.round(f.size/1024)} KB)` : 'Aucun fichier sélectionné';
      });

      form.addEventListener('submit', async function (ev) {
        ev.preventDefault();

        if (!form.checkValidity()) {
          form.classList.add('was-validated');
          return;
        }

        saveBtn.disabled = true;
        saveTxt.textContent = 'Enregistrement...';

        // build payload JSON
        const payload = {};
        const allowed = ['name','firstname','password','phone','address','email','admin','niveau'];
        const fm = new FormData(form);
        for (const [k,v] of fm.entries()) {
          if (k === 'cv') continue; // file not sent here
          if (k === 'password' && (!v || v.trim() === '')) continue;
          if (allowed.includes(k)) payload[k] = v;
        }

        // Determine peopleId from hidden input
        const peopleId = form.querySelector('input[name="people_id"]').value || '<?= $people_id ?>';

        // Build endpoint URL using the same pattern as your advert example:
        // PUT http://localhost/Job_Board/api/index.php/people/{id}
        const origin = window.location.origin;
        // Adjust 'Job_Board' if your folder name differs; this matches your advertisement example
        const basePath = `${origin}/Job_Board/api/index.php/people`;
        let url = `${basePath}/${peopleId}`;

        try {
          // Try PUT first
          let resp = await fetch(url, {
            method: 'PUT',
            headers: { 'Content-Type': 'application/json' },
            credentials: 'same-origin',
            body: JSON.stringify(payload)
          });

          // If server blocks PUT (405), retry with POST + override
          if (resp.status === 405) {
            resp = await fetch(url, {
              method: 'POST',
              headers: {
                'Content-Type': 'application/json',
                'X-HTTP-Method-Override': 'PUT'
              },
              credentials: 'same-origin',
              body: JSON.stringify(payload)
            });
          }

          // If server returns 404 for pretty URL, try sending to index.php with _method
          if (resp.status === 404) {
            // Try POST to index.php with _method=PUT query param (some routers support)
            const urlWithMethod = `${origin}/Job_Board/api/index.php/people/${peopleId}?_method=PUT`;
            resp = await fetch(urlWithMethod, {
              method: 'POST',
              headers: { 'Content-Type': 'application/json' },
              credentials: 'same-origin',
              body: JSON.stringify(payload)
            });
          }

          // Parse response if JSON
          const json = await resp.json().catch(()=>null);

          if (resp.ok && json && (json.status === 'success' || resp.status === 200 || resp.status === 204)) {
            showAlert('success', 'Profil mis à jour avec succès.');

            // Update displayed email & name locally (UI feedback)
            if (payload.email) {
              displayEmail.textContent = payload.email;
              // Also update the email input value (already set)
            }
            // If firstname/lastname were editable we would update displayName and initials:
            if (payload.firstname || payload.name) {
              const newFirstname = payload.firstname || document.getElementById('prenom').value;
              const newName = payload.name || document.getElementById('nom').value;
              displayName.textContent = `${newFirstname} ${newName}`;
              avatarInitials.textContent = (newFirstname[0] || '').toUpperCase() + (newName[0] || '').toUpperCase();
            }

          } else {
            const err = (json && (json.message || JSON.stringify(json))) || `Erreur ${resp.status}`;
            showAlert('danger', `Mise à jour impossible : ${err}`);
          }
        } catch (err) {
          showAlert('danger', `Erreur réseau : ${err.message}`);
        } finally {
          saveBtn.disabled = false;
          saveTxt.textContent = 'Enregistrer';
        }
      });
    })();
  </script>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
