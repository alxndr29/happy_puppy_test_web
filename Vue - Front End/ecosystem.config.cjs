module.exports = {
  apps: [
    {
      name: "vue-app-evan",
      script: "node_modules/.bin/vite",
      args: "preview --port 3112 --host",
      instances: 1,
      exec_mode: "fork",
      max_memory_restart: "100M",
      env: {
        NODE_ENV: "production"
      }
    }
  ]
};
