import UserService from "../services/UserService.js";

function loadUsers() {
  UserService.getAllUsers()
    .then(users => {
      console.log(users);
    })
    .catch(() => alert('Failed to load users'));
}

window.loadUsers = loadUsers;
