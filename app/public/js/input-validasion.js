document.getElementById('courseForm').addEventListener('submit', function (e) {
    const title = document.getElementById('title').value.trim();
    const category = document.getElementById('category').value;
    const description = document.getElementById('description').value.trim();
    const tags = document.getElementById('tags').selectedOptions.length;
    const level = document.getElementById('level').value;
    const type = document.getElementById('type').value;
    const videoUrl = document.getElementById('video-url').value.trim();
    const documentContent = document.getElementById('document').value.trim();
    const duration = document.getElementById('duration').value.trim();
    const price = document.getElementById('price').value.trim();
    const imageUrl = document.getElementById('image-url').value.trim();

    let isValid = true;
    let errorMessage = '';

    // Regular Expressions
    const titleRegex = /^[a-zA-Z0-9\s]{3,100}$/;
    const descriptionRegex = /^[a-zA-Z0-9\s.,!?]{10,300}$/;
    const urlRegex = /^https?:\/\/[^\s]+$/;
    const numberRegex = /^[0-9]+(\.[0-9]+)?$/;

    // Validation Logic
    if (!titleRegex.test(title)) {
        isValid = false;
        errorMessage += 'Le titre doit comporter entre 3 et 100 caractères alphanumériques.\n';
    }
    if (!category) {
        isValid = false;
        errorMessage += 'Veuillez sélectionner une catégorie.\n';
    }
    if (!descriptionRegex.test(description)) {
        isValid = false;
        errorMessage += 'La description doit comporter entre 10 et 300 caractères.\n';
    }
    if (tags === 0) {
        isValid = false;
        errorMessage += 'Veuillez sélectionner au moins un tag.\n';
    }
    if (!level) {
        isValid = false;
        errorMessage += 'Veuillez sélectionner un niveau.\n';
    }
    if (type === 'video' && !urlRegex.test(videoUrl)) {
        isValid = false;
        errorMessage += 'Veuillez fournir une URL valide pour la vidéo.\n';
    }
    if (type === 'document' && documentContent.length < 10) {
        isValid = false;
        errorMessage += 'La description du document doit comporter au moins 10 caractères.\n';
    }
    if (!numberRegex.test(duration) || parseFloat(duration) <= 0) {
        isValid = false;
        errorMessage += 'La durée doit être un nombre positif.\n';
    }
    if (!numberRegex.test(price) || parseFloat(price) < 0) {
        isValid = false;
        errorMessage += 'Le prix doit être un nombre positif ou zéro.\n';
    }
    if (!urlRegex.test(imageUrl)) {
        isValid = false;
        errorMessage += 'Veuillez fournir une URL valide pour l\'image.\n';
    }

    // Prevent Form Submission if Validation Fails
    if (!isValid) {
        e.preventDefault();
        alert(errorMessage);
    }
});

// Dynamic Input Toggle
function updateInputFields() {
    const type = document.getElementById('type').value;
    const videoInput = document.getElementById('video-input');
    const documentTextarea = document.getElementById('document-textarea');

    if (type === 'video') {
        videoInput.style.display = 'block';
        documentTextarea.style.display = 'none';
    } else {
        videoInput.style.display = 'none';
        documentTextarea.style.display = 'block';
    }
}

// Initialize Tag Selector
new TomSelect("#tags", {
    maxItems: 10,
    create: false,
    placeholder: 'Select tags...',
});

