
function AddRange()
{
    var ranges = document.getElementsByClassName("range");
    var range = ranges[0];
    var new_range = range.cloneNode(true);
    var main_element = document.getElementById('ranges');
    console.log(new_range);
    main_element.appendChild(new_range);
}

function SendData(e)
{
    e.preventDefault();
    var form = document.getElementById('main-form').querySelectorAll('input');
    var input = Object.create();
    for(let i=0; i<form.length; i++)
    {
        if(!form[i].name == "type")
        {
            input.setAttribute(form[i].name,form[i].value);
        }
        else
        {
            if(form[i].checked)
            {
                input.setAttribute(form[i].name,true);
            }
            else
            {
                input.setAttribute(form[i].name,false);
            }
        }
    }
    
    var ranges = document.getElementsByClassName('range');

    var values = new Array;
    for(let i=0; i<ranges.length; i++)
    {
        let list = ranges.querySelectorAll('input');
        let input_values = Object.create();
        for(let j=0; j<list.length; j++)
        {
            if(list[i].type != "radio" && list.type != "checkbox")
            {
                input_values.setAttribute(list[i].name,list[i].value);
            }
            else
            {
                if(list[i].type == "radio")
                {
                    if(list[i].checked)
                    {
                        input_values.setAttribute(list[i].name,list[i].value);
                    }
                }
                else
                {
                    if(list[i].checked)
                    {
                        input_values.setAttribute(list[i].name,true);
                    }
                    else
                    {
                        input_values.setAttribute(list[i].name,false);
                    }
                }
            }
        }
        values.push(input_values);
    }
    input.setAttribute("ranges",values);

    SendInput(input);
}

function SendInput(input)
{
    fetch("http://localhost:8000/api/elements/",{
        method:"POST",
        body:JSON.stringify(input),
        headers: {
            "Content-type": "application/json; charset=UTF-8"
        }
    })
    .then(response => response.json())
    .then(json=> json.log)
    {
        console.log("done");
        window.location.reload();
    }
}