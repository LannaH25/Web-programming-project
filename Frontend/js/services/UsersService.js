class UserService {
  getAllUsers() {
    return fetch('/users', {
      headers: {
        'Authorization': 'Bearer ' + localStorage.getItem('token')
      }
    }).then(res => res.json());
  }

  getById(id) {
    return fetch(`/users/${id}`, {
      headers: {
        'Authorization': 'Bearer ' + localStorage.getItem('token')
      }
    }).then(res => res.json());
  }

  create(user) {
    return fetch('/users', {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json'
      },
      body: JSON.stringify(user)
    }).then(res => res.json());
  }
}

export default new UserService();
