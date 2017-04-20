{% extends "base.html" %}
{% block content %}

{% import "macros/forms.html" as forms %}

{% if task.id==null %}
<h1>Lisää uusi tehtävä projektille {{task.project_name}}</h1>
<form method='post' action='{{base_path}}/projektit/{{task.project}}/uusi_tehtava'>
    {% else %}
    <h1>Muokkaa tehtävän {{task.name}} tietoja</h1>
    <form method='post' action='{{base_path}/projektit/{{task.project}}/{{task.id}}/muokkaa'>
        {% endif %}


        <div class="form-group">
            <label>Nimi</label>
            <input type="text" name='name' class="form-control" value="{{task.name}}">
        </div>
        <div class="form-group">
            <label>Kuvaus</label>
            <input type="text" name='description' class="form-control" value="{{task.description}}">
        </div>
        <div class="form-group">
            <label>Aloituspäivä</label>
            <input type="date" name='start_date' class="form-control" value="{{task.start_date}}">
        </div>
        <div class="form-group">
            <label>Deadline</label>
            <input type="date" name='deadline' class="form-control" value="{{task.deadline}}">
        </div>
        <div class="form-group">
            <label>Aktiivisuus</label>
            <select  id="act" class='form-control' name="active">
                <script>
                    var select = document.getElementById("act");
                    var el1 = document.createElement("option");
                    var el2 = document.createElement("option");
                    el1.textContent = "Käytettävissä";
                    el1.value = "true";
                    el2.textContent = "Ei käytettävissä";
                    el2.value = "false";
                    if ('{{person.active}}' == true) {
                        el1.selected = true;
                    } else {
                        el2.selected = true;
                    }
                    select.appendChild(el1);
                    select.appendChild(el2);
                </script>
            </select>
        </div>
        {% endif %}
        

        
        {{forms.cancel_save("#{base_path}/kayttajat/#{person.id}")}}

    </form>
    {% endblock %}