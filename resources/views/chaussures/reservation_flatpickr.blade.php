<!-- Inclure Flatpickr via CDN dans le head ou avant le script JS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>

<!-- Structure HTML Simple -->
<div class="reservation-form">
    <label for="reservation_dates">Choisissez votre période d'emprunt :</label>
    <input type="text" id="reservation_dates" placeholder="Sélectionner une plage de dates...">
    
    <!-- Champs cachés pour le formulaire Laravel -->
    <input type="hidden" id="start_date" name="start_date">
    <input type="hidden" id="end_date" name="end_date">
    <input type="hidden" name="shoe_id" value="1"> <!-- Exemple -->
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Initialisation de Flatpickr en mode "range"
    flatpickr("#reservation_dates", {
        mode: "range",
        minDate: "today",
        dateFormat: "Y-m-d",
        onClose: function(selectedDates, dateStr, instance) {
            if (selectedDates.length === 2) {
                // Remplissage des champs cachés pour l'envoi au backend
                const start = instance.formatDate(selectedDates[0], "Y-m-d 00:00:00");
                const end = instance.formatDate(selectedDates[1], "Y-m-d 23:59:59");
                
                document.getElementById('start_date').value = start;
                document.getElementById('end_date').value = end;
                
                console.log("Période sélectionnée :", start, "au", end);
            }
        },
        // Optionnel : Désactiver les dates déjà réservées (exemple statique)
        // disable: [
        //     {
        //         from: "2026-04-10",
        //         to: "2026-04-15"
        //     }
        // ]
    });
});
</script>
