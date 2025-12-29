class PropertyService {

  getAll() {
    return fetch('/properties')
      .then(res => res.json());
  }

  getById(id) {
    return fetch(`/properties/${id}`)
      .then(res => res.json());
  }

  create(property) {
    return fetch('/properties', {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json'
      },
      body: JSON.stringify(property)
    }).then(res => res.json());
  }

  update(id, property) {
    return fetch(`/properties/${id}`, {
      method: 'PUT',
      headers: {
        'Content-Type': 'application/json'
      },
      body: JSON.stringify(property)
    }).then(res => res.json());
  }

  delete(id) {
    return fetch(`/properties/${id}`, {
      method: 'DELETE'
    }).then(res => res.json());
  }

}

export default new PropertyService();
