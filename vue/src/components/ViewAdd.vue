<template>
  <div>
    <h1>Dodaj wiadomość</h1>
    <form @submit.prevent="addMessage">
      <label for="message">Wiadomość:</label>
      <input v-model="message" type="text" id="message" name="message" required>
      <button type="submit">Dodaj</button>
    </form>
  </div>
</template>

<script>
export default {
  data() {
    return {
      message: '',
    };
  },
  methods: {
    async addMessage() {
      try {
        const data = {
          message: this.message,
        };

        const response = await fetch('http://127.0.0.1:8000/api/message', {
          method: 'POST',
          headers: {
            'Content-Type': 'application/json',
          },
          body: JSON.stringify(data),
        });

        if (response.ok) {
          this.message = '';
          alert('Wiadomość została dodana!');
        } else {
          alert('Wystąpił błąd podczas dodawania wiadomości.');
        }
      } catch (error) {
        console.error('Wystąpił błąd:', error);
      }
    },
  },
};
</script>