import MessageService from "../services/MessageService.js";

window.loadMessages = function () {
  MessageService.getAll()
    .then(messages => {
      console.log(messages); 
    })
    .catch(() => alert('Failed to load messages'));
};

document.addEventListener('submit', function (e) {
  if (e.target.id !== 'message-form') return;

  e.preventDefault();

  const message = {
    sender: document.getElementById('sender').value,
    content: document.getElementById('content').value
  };

  MessageService.create(message)
    .then(() => {
      alert('Message sent');
    })
    .catch(() => alert('Message failed'));
});


window.deleteMessage = function (id) {
  if (!confirm('Delete message?')) return;

  MessageService.delete(id)
    .then(() => alert('Message deleted'))
    .catch(() => alert('Delete failed'));
};
