<template>
  <div>
    <h1>Odczytaj wiadomość</h1>
    <form @submit.prevent="getMessage">
      <label for="uuid">UUID:</label>
      <input v-model="uuid" type="text" id="uuid" name="uuid" required>
      <button type="submit">Pobierz</button>
    </form>

    <div v-if="messageData">
      <h2>Wiadomość:</h2>
      <p><strong>UUID:</strong> {{ messageData.uuid }}</p>
      <p><strong>Wiadomość:</strong> {{ messageData.message }}</p>
      <p><strong>Utworzono:</strong> {{ messageData.created_at }}</p>
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      uuid: '', 
      messageData: null, 
    };
  },
  methods: {
    async getMessage() {
      try {
        const uuid = this.uuid;

        const response = await fetch(`http://127.0.0.1:8000/api/message/${uuid}`);

        if (response.ok) {
          this.messageData = await response.json();
        } else {
          alert('Wystąpił błąd podczas pobierania wiadomości.');
          this.messageData = null; 
        }
      } catch (error) {
        console.error('Wystąpił błąd:', error);
        this.messageData = null; 
      }
    },
  },
};
</script>
