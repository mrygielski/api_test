<template>
  <div>
    <h1>Lista wiadomości</h1>
    <dx-data-grid
      :data-source="messages"
      :columns="[
        { dataField: 'uuid', caption: 'UUID' },
        { dataField: 'message', caption: 'Wiadomość' },
        { dataField: 'created_at', caption: 'Utworzono' },
      ]"
    ></dx-data-grid>
  </div>
</template>

<script>
import axios from 'axios';

export default {
  data() {
    return {
      messages: [],
    };
  },
  mounted() {
    this.fetchMessages();
  },
  methods: {
    fetchMessages() {
      axios
        .get('http://127.0.0.1:8000/api/messages')
        .then((response) => {
          this.messages = response.data.map((message) => ({
            uuid: message.uuid,
            message: message.message,
            created_at: message.created_at,
          }));
        })
        .catch((error) => {
          console.error('Błąd podczas pobierania danych:', error);
        });
    },
  },
};
</script>
