const fighters_parent = document.getElementById('fighters-parent');
fetch("http://127.0.0.1:8000/fighter/fighter-api", {
    method: 'GET',

    headers: {
        'Content-type': 'application/json'
    },
})
    .then(response => response.json())
    .then(fighters => {
        console.log(fighters)
        let carte_fighters = fighters.map((fighter) => 
            `
            <div>
                <h2 class="text-warning">${fighter.name}</h2>
            </div>
            `
        )
        fighters_parent.innerHTML = carte_fighters.join(' ');
    })
    .catch(error => console.error(error))