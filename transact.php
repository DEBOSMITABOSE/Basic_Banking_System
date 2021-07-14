<?php
include 'connection.php';
$sender=$_POST['sender'];
$receiver=$_POST['receiver'];
$amount=$_POST['amount'];
if($sender==$receiver)
{
     echo(" 
     <script>
     alert('Choose Proper Sender and Reciever')
     window.location.href='index.html'
     </script>
     ");

}

else
{
    $select="SELECT * from banking_system where username='$sender'";
    $query1=$connection->query($select);
    $res=mysqli_fetch_array($query1);
    if($res['balance']<$amount)
    {
        echo(" 
        <script>
        alert('Please Check the Amount')
        window.location.href='index.html'
        </script>
        ");
    }
    else
    {
        $money1=$res['balance']-$amount;
        $select1="UPDATE banking_system set balance='$money1' where username='$sender' ";
        $query1=$connection->query($select1);
        $select2="SELECT * from banking_system where username='$receiver'";
        $query2=$connection->query($select2);
        $res2=mysqli_fetch_array($query2);
        $money2=$res2['balance']+$amount;
        $select3="UPDATE banking_system set balance='$money2' where username='$receiver' ";
        $query3=$connection->query($select3);
        if($query1 && $query3)
        {
             $insert="INSERT INTO Transaction SET Sender='$sender' ,Reciever='$receiver' , Amount='$amount'";
             $query4=$connection->query($insert);
             echo(" 
             <script>
             alert('Success')
             window.location.href='alluser.php'
             </script>
             ");
        }
        else
        {
             echo(" 
            <script>
            alert('Something Went Wrong!!!Please Try Again')
            window.location.href='index.html'
            </script>
            ");
        }

    }
}
?>