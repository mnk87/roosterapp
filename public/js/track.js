for(let i = 0; i < workstations.length; i++)
{
    let ws = workstations[i];
    let wsid = ws.id;
    let workstationtr = document.getElementById('workstation-ochtend-' + wsid);
    //ochtend
    getName(workstationtr.children[1], ws, 'maandag', 'ochtend');
    getName(workstationtr.children[2], ws, 'dinsdag', 'ochtend');
    getName(workstationtr.children[3], ws, 'woensdag', 'ochtend');
    getName(workstationtr.children[4], ws, 'donderdag', 'ochtend');
    getName(workstationtr.children[5], ws, 'vrijdag', 'ochtend');

    workstationtr = document.getElementById('workstation-middag-' + wsid);
    //middag
    getName(workstationtr.children[1], ws, 'maandag', 'middag');
    getName(workstationtr.children[2], ws, 'dinsdag', 'middag');
    getName(workstationtr.children[3], ws, 'woensdag', 'middag');
    getName(workstationtr.children[4], ws, 'donderdag', 'middag');
    getName(workstationtr.children[5], ws, 'vrijdag', 'middag');

}

function getName(td, workstation, day, dagdeel)
{
    
    let dd = workstation.days[day][dagdeel];
    let id = dd.id;
    if(dd.isActive == 1 && dd.id == 0)
    {
        td.classList.add('vrij');
        td.textContent = 'vrij';
        return;
    }
    if(dd.isActive == 0)
    {
        td.classList.add('inactive');
        td.textContent = "+";
        return; 
    }
    for(let i = 0; i < medients.length; i++)
    {
        if(medients[i].id == id)
        {
            td.classList.add('bezet');
            td.textContent = medients[i].name;
            if(dd.isReserved == 1)
            {
                td.classList.add('reserved');
                return;
            }
            if(dd.startsLater == 1 && dd.endsEarlier == 1)
            {
                td.classList.add('slee');
                return;
            }
            if(dd.startsLater == 1 && dd.endsEarlier == 0)
            {
                td.classList.add('sl');
                return;
            }
            if(dd.startsLater == 0 && dd.endsEarlier == 1)
            {
                td.classList.add('ee');
                return;
            }
            return;
        }
    }
    
    
}
var fields = [];
document.addEventListener('click', function (e) {
    let id = e.target.id;
    if (e.ctrlKey || e.metaKey) {
        if(id.startsWith('ochtend') || id.startsWith('middag')){
            fields.push(id);
        }
    return;
    } else {
        if(id.startsWith('ochtend') || id.startsWith('middag')){
            fields.push(id);
            $('#trackModal').modal('show');
        }
        return;
    }
});

document.addEventListener('keyup', function(e) {
    if(e.key == 'Control')
    {
        if(fields.length != 0){
            $('#trackModal').modal('show');
        }
        return;
    }
});

$('#trackModal').on('hidden.bs.modal', function (e) {
    fields = [];
    console.log('geleegd');
});

function sendData()
{
    //waardes ophalen
    const medientId = document.getElementById('medients').value;
    const startsLater = document.getElementById('startsLater').checked;
    let sL;
    startsLater ? sL = 1 : sL = 0;
    const endsEarlier = document.getElementById('endsEarlier').checked;
    let eE;
    endsEarlier ? eE = 1 : eE = 0;
    const reserved = document.getElementById('reserved').checked;
    let rs;
    reserved ? rs = 1 : rs = 0;
    const turnOff = document.getElementById('turnOff').checked;
    let tO;
    turnOff ? tO = 1 : tO = 0;
    //request maken
    axios({
        method: 'put',
        url: '/ws',
        data: {
          medientId: medientId,
          startsLater: sL,
          endsEarlier: eE,
          reserved: rs,
          turnOff: tO,
          fields: fields
        }
      }).then(function (response) {
            location.reload(true);
      });
}
