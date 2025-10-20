

document.addEventListener('DOMContentLoaded', function () {
    setTimeout(function () {
        const message = document.getElementById('login_error');
        if (message) {
            message.style.display = 'none';
        }
    }, 3000);
});

document.addEventListener('DOMContentLoaded', function () {
    setTimeout(function () {
        const message = document.getElementById('create_user_success');
        if (message) {
            message.style.display = 'none';
        }
    }, 3000);
});

document.addEventListener('DOMContentLoaded', function () {
    setTimeout(function () {
        const message = document.getElementById('update_cuidador_success');
        if (message) {
            message.style.display = 'none';
        }
    }, 3000);
});

document.addEventListener('DOMContentLoaded', function () {
    setTimeout(function () {
        const message = document.getElementById('update_cliente_success');
        if (message) {
            message.style.display = 'none';
        }
    }, 3000);
});

document.addEventListener('DOMContentLoaded', function () {
    setTimeout(function () {
        const message = document.getElementById('email-success');
        if (message) {
            message.style.display = 'none';
        }
    }, 3000);
});

// // api para buscar o cep
// $(document).ready(function () {
//       $('#cep').on('blur', function () {
//         let cep = $('#cep').val().replace(/\D/g, '');

//         if (cep.length === 8) {
//           $.getJSON(`https://viacep.com.br/ws/${cep}/json/`, function (dados) {
//             if (!("erro" in dados)) {
//               $('#rua').val(dados.logradouro);
//               $('#bairro').val(dados.bairro);
//               $('#cidade').val(dados.localidade);
//             } else {
//               alert("CEP não encontrado.");
//             }
//           }).fail(function () {
//             alert("Erro ao consultar o CEP.");
//           });
//         } else {
//           alert("CEP inválido.");
//         }
//       });
//     });

document.addEventListener('DOMContentLoaded', () => {
    const cepInput = document.getElementById('cep');
    const ruaInput = document.getElementById('rua');
    const bairroInput = document.getElementById('bairro');
    const cidadeInput = document.getElementById('cidade');

    cepInput.addEventListener('blur', async () => {
        let cep = cepInput.value.replace(/\D/g, ''); // remove tudo que não for número

        if (cep.length !== 8) {
            alert('CEP inválido.');
            return;
        }

        try {
            const response = await fetch(`https://viacep.com.br/ws/${cep}/json/`);
            if (!response.ok) throw new Error('Erro na requisição');

            const data = await response.json();
            if (data.erro) {
                alert('CEP não encontrado.');
                ruaInput.value = '';
                bairroInput.value = '';
                cidadeInput.value = '';
                return;
            }

            // Preenche os campos automaticamente
            ruaInput.value = data.logradouro;
            bairroInput.value = data.bairro;
            cidadeInput.value = data.localidade;

        } catch (error) {
            console.error(error);
            alert('Não foi possível consultar o CEP. Tente novamente.');
        }
    });
});












// document.addEventListener('DOMContentLoaded', () => {
//     const cepInput = document.getElementById('cep');
//     const ruaInput = document.getElementById('rua');
//     const bairroInput = document.getElementById('bairro');
//     const cidadeInput = document.getElementById('cidade');

//     cepInput.addEventListener('blur', async () => {
//         let cep = cepInput.value.replace(/\D/g, ''); // remove tudo que não for número

//         if (cep.length !== 8) {
//             alert('CEP inválido.');
//             return;
//         }

//         try {
//             const response = await fetch(`https://viacep.com.br/ws/${cep}/json/`);
//             if (!response.ok) throw new Error('Erro na requisição');

//             const data = await response.json();
//             if (data.erro) {
//                 alert('CEP não encontrado.');
//                 ruaInput.value = '';
//                 bairroInput.value = '';
//                 cidadeInput.value = '';
//                 return;
//             }

//             // Preenche os campos automaticamente
//             ruaInput.value = data.logradouro;
//             bairroInput.value = data.bairro;
//             cidadeInput.value = data.localidade;

//         } catch (error) {
//             console.error(error);
//             alert('Não foi possível consultar o CEP. Tente novamente.');
//         }
//     });
// });
