<template>
  <div class="flex items-center justify-center min-h-screen bg-gradient-to-r from-purple-500 via-indigo-500 to-blue-500">
    <div class="p-8 bg-white bg-opacity-30 backdrop-filter backdrop-blur-lg rounded-xl shadow-xl w-full max-w-md">
      <h1 class="text-2xl font-bold text-center mb-6" style="font-family: 'Inter', sans-serif;">Login</h1>
      <form @submit.prevent="submit">
        <div class="mb-4">
          <label class="block text-sm font-medium mb-1" for="email">Email</label>
          <input v-model="form.email" type="email" id="email" required class="w-full px-3 py-2 border rounded focus:outline-none focus:ring-2 focus:ring-indigo-500" />
        </div>
        <div class="mb-6">
          <label class="block text-sm font-medium mb-1" for="password">Password</label>
          <input v-model="form.password" type="password" id="password" required class="w-full px-3 py-2 border rounded focus:outline-none focus:ring-2 focus:ring-indigo-500" />
        </div>
        <button type="submit" class="w-full py-2 bg-indigo-600 hover:bg-indigo-700 text-white font-semibold rounded transition-colors">Login</button>
      </form>
    </div>
  </div>
</template>

<script>
import { Inertia } from '@inertiajs/inertia';
export default {
  data() {
    return {
      form: {
        email: '',
        password: ''
      }
    };
  },
  methods: {
    submit() {
      Inertia.post('/login', this.form);
    }
  }
};
</script>

<style scoped>
/* Premium glassmorphism */
</style>
