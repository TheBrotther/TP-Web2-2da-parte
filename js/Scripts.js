"use strict"
const URL = 'http://localhost/2daParte/api/clients/';

let clients = [];

let form = document.querySelector('#client-form');
form.addEventListener('submit', insertClient);


async function getAllClients() {
    try {
        let response = await fetch(URL);
        if (!response.ok) {
            throw new Error('Recurso no existe');
        }
        clients= await response.json();

        showClients();
    } catch(e) {
        console.log(e);
    }
}


async function insertClient(e) {
    e.preventDefault();
    
    let data = new FormData(form);
    let client = {
        dni: data.get('dni'),
        alias: data.get('alias'),
        city: data.get('city'),
    };

    try {
        let response = await fetch(URL, {
            method: "POST",
            headers: { 'Content-Type': 'application/json'},
            body: JSON.stringify(client)
        });
        if (!response.ok) {
            throw new Error('Error del servidor');
        }

        let nClient = await response.json();
        clients.push(nClient);
        showClients();

        form.reset();
    } catch(e) {
        console.log(e);
    }
}

async function deleteClient(e) {
    e.preventDefault();
    try {
        let id = e.target.dataset.client;
        let response = await fetch(URL + id, {method: 'DELETE'});
        if (!response.ok) {
            throw new Error('Recurso no existe');
        }
        clients = clients.filter(client => client.id_client!= id);
        showClients();
    } catch(e) {
        console.log(e);
    }   
}



function showClients() {
    let ul = document.querySelector("#client-list");
    ul.innerHTML = "";
    for (const client of clients) {

        let html = `
            <li class='list-group-item d-flex justify-content-between align-items-center'>
                <span> ${client.dni} - ${client.alias} - ${client.city} </span>
                <a href='#' data-client="${client.id_client}" type='button' class='btn btn-danger btn-delete'>Borrar</a>
            </li>
        `;

        ul.innerHTML += html;
    }
    const btnsDelete = document.querySelectorAll('a.btn-delete');
    for (const btnDelete of btnsDelete) {
        btnDelete.addEventListener('click', deleteClient);
    }
}

getAllClients()

