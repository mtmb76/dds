
            $(document).ready(function () {
                $('#container').simpleCalendar({
                    fixedStartDay: true,
                    displayYear: true,
                    disableEventDetails: false,
                    disableEmptyDetails: true,
                    months: ['Janeiro', 'Fevereiro', 'Março', 'Abril', 'Maio', 'Junho', 'Julho', 'Agosto', 'Setembro', 'Outubro', 'Novembro', 'Dezembro'],
                    days: ['Domingo', 'Segunda', 'Terça', 'Quarta', 'Quinta', 'Sexta', 'Sábado'],
                    events: [
                    {startDate: "2023-03-09",  endDate: "2023-03-09",  summary:"<a style='font-size:14px; color:#eee089;' href='http://localhost:8000/evento/view/5'>Evento #5</a><br>Turno: 1º<br>Setor: Administrativo<br>Tema: DESTINAÇÃO DE RESÍDUOS"},{startDate: "2023-03-09",  endDate: "2023-03-09",  summary:"<a style='font-size:14px; color:#eee089;' href='http://localhost:8000/evento/view/7'>Evento #7</a><br>Turno: 3º<br>Setor: Administrativo<br>Tema: DESTINAÇÃO DE RESÍDUOS"},{startDate: "2023-03-10",  endDate: "2023-03-10",  summary:"<a style='font-size:14px; color:#eee089;' href='http://localhost:8000/evento/view/6'>Evento #6</a><br>Turno: 2º<br>Setor: Administrativo<br>Tema: DESTINAÇÃO DE RESÍDUOS"},
                    ],
                });
            });
        