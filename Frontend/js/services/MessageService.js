class MessageService {

  getAll() {
    return fetch('/messages')
      .then(res => res.json());
  }

  getById(id) {
    return fetch(`/messages/${id}`)
      .then(res => res.json());
  }

  create(message) {
    return fetch('/messages', {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json'
      },
      body: JSON.stringify(message)
    }).then(res => res.json());
  }

  update(id, message) {
    return fetch(`/messages/${id}`, {
      method: 'PUT',
      headers: {
        'Content-Type': 'application/json'
      },
      body: JSON.stringify(message)
    }).then(res => res.json());
  }

  delete(id) {
    return fetch(`/messages/${id}`, {
      method: 'DELETE'
    }).then(res => res.json());
  }

}

export default new MessageService();
