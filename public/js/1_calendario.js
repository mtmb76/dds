
            $(document).ready(function () {
                $('#container').simpleCalendar({
                    fixedStartDay: true,
                    displayYear: true,
                    disableEventDetails: false,
                    disableEmptyDetails: true,
                    months: ['Janeiro', 'Fevereiro', 'Março', 'Abril', 'Maio', 'Junho', 'Julho', 'Agosto', 'Setembro', 'Outubro', 'Novembro', 'Dezembro'],
                    days: ['Domingo', 'Segunda', 'Terça', 'Quarta', 'Quinta', 'Sexta', 'Sábado'],
                    events: [
                    {startDate: "2023-02-28",  endDate: "2023-02-28",  summary:"<a style='font-size:14px; color:#eee089;' href='http://localhost:8000/evento/view/1'>Evento #1</a><br>Turno: 2º<br>Setor: Administrativo<br>Tema: DESTINAÇÃO DE RESÍDUOS SÓLIDOS"},
                    ],
                });
            });
        