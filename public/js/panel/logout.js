document.getElementById("btnLogout").addEventListener("click", async () => {
  try {
    const res = await fetch("/barber/auth-logout", { method: "POST" });
    const data = await res.json();

    if (data.success) {
      localStorage.removeItem("usuario"); // limpiar también en el front
      window.location.href = "/barber"; // redirigir al login
    } else {
      alert("Error al cerrar sesión");
    }
  } catch (err) {
    console.error("Error en logout:", err);
    alert("Error al conectar con el servidor");
  }
});
