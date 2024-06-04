document.querySelector("form").addEventListener("submit", (e) => {
  e.preventDefault();

  const name = document.querySelector("input[name='name']").value;
  const phone = document.querySelector("input[name='phone']").value;

  const data = {
    name: name,
    phone: phone,
  };

  sendForm(data);
});

async function sendForm(data) {
  const res = await fetch("./feedback.php", {
    method: "POST",
    headers: { "Content-type": "application/json" },
    body: JSON.stringify(data),
  });

  const result = await res.json();

  if (res.status === 201) {
    alert(`Спасибо! ${result.message}`);
  } else {
    alert("Упс, что-то пошло не так");
  }
}
