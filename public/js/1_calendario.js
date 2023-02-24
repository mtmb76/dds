
            $(document).ready(function () {
                $('#container').simpleCalendar({
                    fixedStartDay: true,
                    displayYear: true,
                    disableEventDetails: false,
                    disableEmptyDetails: true,
                    months: ['Janeiro', 'Fevereiro', 'Março', 'Abril', 'Maio', 'Junho', 'Julho', 'Agosto', 'Setembro', 'Outubro', 'Novembro', 'Dezembro'],
                    days: ['Domingo', 'Segunda', 'Terça', 'Quarta', 'Quinta', 'Sexta', 'Sábado'],
                    events: [
                    {startDate: "2023-02-25",  endDate: "2023-02-25",  summary:"<a style='font-size:14px; color:#eee089;' href='http://127.0.0.1:8000/evento/view/1'>Evento #1</a><br>Turno: 1º<br>Setor: Operacional<br>Tema: OldLace"},
                    ],
                });
            });
        