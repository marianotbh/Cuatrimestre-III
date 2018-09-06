<?php
    include_once("./Entidades/App24/Fabrica.php");
    function TestFabrica()
    {
        $op1 = new Operario(456543, "Ramón", "Sánchez");
        $op2 = new Operario(453443, "Ramón", "Lopez");
        $op3 = new Operario(453213, "Ramón", "Gomez");
        $op4 = new Operario(423453, "Ramón", "Ramirez");
        $op5 = new Operario(433333, "Ramón", "Gimenez");
        $op6 = new Operario(456543, "Ramón", "Rodriguez");
        $op7 = new Operario(452343, "Ramón", "NoSánchez");

        $fab = new Fabrica("Fábrica & co.");

        $fab->Add($op1);
        $fab->Add($op2);
        $fab->Add($op3);
        $fab->Add($op4);
        $fab->Add($op5);
        $fab->Add($op6);
        $fab->Add($op7);

        echo $fab->Mostrar();

        $fab->Remove($op5);
        $op3->SetAumentarSalario(30);

        echo $fab->Mostrar();
    }
?>