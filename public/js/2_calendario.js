
            $(document).ready(function () {
                $('#container').simpleCalendar({
                    fixedStartDay: true,
                    displayYear: true,
                    disableEventDetails: false,
                    disableEmptyDetails: true,
                    months: ['Janeiro', 'Fevereiro', 'Março', 'Abril', 'Maio', 'Junho', 'Julho', 'Agosto', 'Setembro', 'Outubro', 'Novembro', 'Dezembro'],
                    days: ['Domingo', 'Segunda', 'Terça', 'Quarta', 'Quinta', 'Sexta', 'Sábado'],
                    events: [
                    {startDate: "2023-03-03",  endDate: "2023-03-03",  summary:"<a style='font-size:14px; color:#eee089;' href='http://localhost:8000/evento/view/1'>Evento #1</a><br>Turno: 1º<br>Setor: Administrativo<br>Tema: 10 ALIMENTOS QUE AJUDAM A FORTALECER O SISTEMA IMUNOLOGICO"},{startDate: "2023-03-03",  endDate: "2023-03-03",  summary:"<a style='font-size:14px; color:#eee089;' href='http://localhost:8000/evento/view/6'>Evento #6</a><br>Turno: 2º<br>Setor: Administrativo<br>Tema: 169 - HIPERTENSÃO (PRESSÃO ALTA"},{startDate: "2023-03-07",  endDate: "2023-03-07",  summary:"<a style='font-size:14px; color:#eee089;' href='http://localhost:8000/evento/view/2'>Evento #2</a><br>Turno: 1º<br>Setor: Operacional<br>Tema: 100 DIAS SEM ACIDENTES COM AFASTAMENTO"},
                    ],
                });
            });
        