import PropertyService from "../services/PropertyService.js";

window.loadProperties = function () {
  PropertyService.getAll()
    .then(properties => {
      console.log(properties); 
    })
    .catch(() => alert('Failed to load properties'));
};
document.addEventListener('submit', function (e) {
  if (e.target.id !== 'property-form') return;

  e.preventDefault();

  const property = {
    title: document.getElementById('title').value,
    price: document.getElementById('price').value,
    location: document.getElementById('location').value
  };

  PropertyService.create(property)
    .then(() => {
      alert('Property created');
      window.location.hash = '#home';
    })
    .catch(() => alert('Create failed'));
});

window.deleteProperty = function (id) {
  if (!confirm('Delete property?')) return;

  PropertyService.delete(id)
    .then(() => alert('Property deleted'))
    .catch(() => alert('Delete failed'));
};
