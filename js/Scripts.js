"use strict"

//Parte del cliente

const URL = 'http://localhost/2daParte/api/clients/';

let clients = [];

let formClient = document.querySelector('#client-form');
let formAccount = document.querySelector('#account-form');
let select = document.querySelector('#select-client');
formClient.addEventListener('submit', insertClient);  
formAccount.addEventListener('submit', insertAccount);


async function getAllClients() {
    try {
        let response = await fetch(URL);
        if (!response.ok) {
            throw new Error('Recurso no existe');
        }
        clients= await response.json();

        showClients();
        optionSelect();
    } catch(e) {
        console.log(e);
    }
}


async function insertClient(e) {
    e.preventDefault();
    
    let data = new FormData(formClient);
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

        formClient.reset();
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




function optionSelect(){
    for(const client of clients){
        let opcion = `<option value="${client.id_client}"> <span>${client.alias}</span> </option>`;
        select.innerHTML += opcion;
    }

}


getAllClients();

//Parte de la cuenta

const URL2 = 'http://localhost/2daParte/api/accounts/';

let accounts = [];



async function getAllAccounts() {
    try {
        let response = await fetch(URL2);
        if (!response.ok) {
            throw new Error('Recurso no existe');
        }
        accounts = await response.json();

        showAccounts();
    } catch(e) {
        console.log(e);
    }
}

async function insertAccount(e) {
    e.preventDefault();
    
    let data = new FormData(formAccount);
    let account = {
        id_client: data.get('id_client'),
        amount: data.get('amount'),
        type_account: data.get('type_account'),
        coin: data.get('coin'),
    };

    try {
        let response = await fetch(URL2, {
            method: "POST",
            headers: { 'Content-Type': 'application/json'},
            body: JSON.stringify(account)
        });
        if (!response.ok) {
            throw new Error('Error del servidor');
        }

        let nAccount = await response.json();
        accounts.push(nAccount);
        showAccounts();

        formAccount.reset();
    } catch(e) {
        console.log(e);
    }
}

async function deleteAccount(e) {
    e.preventDefault();
    try {
        let id = e.target.dataset.account;
        let response = await fetch(URL2 + id, {method: 'DELETE'});
        if (!response.ok) {
            throw new Error('Recurso no existe');
        }
        accounts = accounts.filter(account => account.id_account!= id);
        showAccounts();
    } catch(e) {
        console.log(e);
    }   
}

function showAccounts() {
    let ul = document.querySelector("#account-list");
    ul.innerHTML = "";
    for (const account of accounts) {

        let html = `
            <li class='list-group-item d-flex justify-content-between align-items-center'>
                <span> ${account.id_client} - ${account.amount} - ${account.type_account} - ${account.coin} </span>
                <a href='#' data-client="${account.id_account}" type='button' class='btn btn-danger btn-delete'>Borrar</a>
            </li>
        `;

        ul.innerHTML += html;
    }
    const btnsDelete = document.querySelectorAll('a.btn-delete');
    for (const btnDelete of btnsDelete) {
        btnDelete.addEventListener('click', deleteAccount);
    }
}

getAllAccounts();





