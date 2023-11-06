// The action for creating a user
document.querySelector("#create-user").onclick = function ($e) {
    sendCreateRequest($e.target.form);  
};

// The action for updating the user
document.querySelector("#update-user").onclick = function ($e) {
    sendUpdateRequest($e.target.form);  
};

// The action for deleting the user
document.querySelectorAll(".delete-action").forEach(function(element) {
    element.onclick = function ($e) {
        sendDeleteRequest($e.target.dataset);
    }
});

document.querySelectorAll(".update-action").forEach(function(element) {
    element.onclick = function ($e) {
        updateAction($e.target.dataset);
    }
});

document.querySelector("#cancel-update-user").onclick = function ($e) {
    document.querySelector('#create-action-block').style.display = 'block';
    document.querySelector('#update-action-block').style.display = 'none';

    document.querySelector("#user_form #id").value = '';
}

const sendRequest = function (url, data) {
    return axios.post(url, data);
}

const sendCreateRequest = function (form) {
    const data = new FormData(form);

    sendRequest('/api/users/create', data).then(response => {
        const user = Object.fromEntries(data);
        const positions = form.querySelector('#position');

        user.id = response.data;
        user.position = positions.options[positions.selectedIndex].text;

        addUser(user);
    });
}

const sendUpdateRequest = function (form) {
    const data = new FormData(form);

    sendRequest('/api/users/update', data).then(response => {
        const user = Object.fromEntries(data);
        const positions = form.querySelector('#position');

        user.position = positions.options[positions.selectedIndex].text;

        updateUser(user);
    });
}

const sendDeleteRequest = function (form) {
    const data = new FormData();

    data.append('id', form.id);

    sendRequest('/api/users/delete', data).then(response => {
        deleteUser(form);
    });
}

const addUser = function (user) {
    const table = document.querySelector('#users');
    const row = table.insertRow(-1);

    const c1 = row.insertCell(0);
    const c2 = row.insertCell(1);
    const c3 = row.insertCell(2);
    const c4 = row.insertCell(3);

    c1.innerText = user.first_name;
    c2.innerText = user.last_name;
    c3.innerText = user.position;
    c4.appendChild(getActionButton('update', user.id));
    c4.appendChild(getActionButton('delete', user.id));
}

const updateUser = function (user) {
    const table = document.querySelector('#users tr[data-id="' + user.id + '"]');

    table.querySelector('.first_name').innerText = user.first_name;
    table.querySelector('.last_name').innerText = user.last_name;
    table.querySelector('.position').innerText = user.position;
}

const deleteUser = function (user) {
    document.querySelector('#users tr[data-id="' + user.id + '"]').remove();
}

const updateAction = function (attr) {
    document.querySelector('#create-action-block').style.display = 'none';
    document.querySelector('#update-action-block').style.display = 'block';

    const form = document.querySelector("#user_form");

    form.querySelector('#id').value = attr.id;
    form.querySelector('#first_name').value = attr.first_name;
    form.querySelector('#last_name').value = attr.last_name;

    const position = form.querySelector('#position');

    for (let i = 0; i < position.options.length; i++) {
        if (position.options[i].value === attr.position_id) {
            position.selectedIndex = i;
            break;
        }
    }
}

const getActionButton = function (name, attr) {
    const button = document.createElement("button");

    button.type = "button";

    button.textContent = name;

    button.dataset.id = attr;

    return button;
}