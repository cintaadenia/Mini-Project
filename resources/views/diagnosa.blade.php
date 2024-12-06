
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Diagnosis</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Bebas+Neue&family=Open+Sans:ital,wght@0,300..800;1,300..800&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
        rel="stylesheet">
    <style>
        :root {
            --main-color: #0F8CA9;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Open Sans', sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }

        .content-wrapper {
            margin: 4rem;
            padding: 20px;
        }

        .titles {
            display: flex;
            margin-bottom: 2rem;
            align-items: center;
        }

        .titles h2 {
            font-size: 3rem;
            margin-right: 2rem;
        }

        .btn-add {
            background-color: var(--main-color);
            color: white;
            border: none;
            padding: 1rem 1.5rem;
            border-radius: 4px;
            cursor: pointer;
            font-size: 1.5rem;
            font-weight: 600;
        }

        .outer-table {
            width: 1600px;
            height: 80vh;
            text-align: left;
            background-color: #ffffff;
            border: 1px solid #6c6c6c;
            border-radius: 6px;
            padding: 1rem;
        }
        
        .table {
            font-weight: 600;
            width: 100%;
        }

        
        .table th {
            padding: 0.5rem 1rem;
            text-align: left;
            background-color: #ededed;
        }
        
        .table th,
        .table td {
            padding: 1.5rem;
        }
        
        .table td {
            margin: 1rem;
            color: #4f4f4f;
        }

        .btn-add:hover {
            background-color: #006666;
        }

        .actions i{
            font-size: 1.5rem ;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="content-wrapper">
            <div class="titles">
                <h2>Data Diagnosis</h2>
                <button class="btn-add">Tambah Diagnosis</button>
            </div>
            <div class="outer-table">
                <table class="table">
                    <tr>
                        <th>Nama Pasien</th>
                        <th>Deskripsi Diagnosis</th>
                        <th>Aksi</th>
                    </tr>
                    <tr>
                        <td>Ani Rahmawati</td>
                        <td>Infeksi saluran pernapasan atas</td>
                        <td class="actions">
                            <i class="fas fa-edit"></i>
                            <i class="fas fa-trash-alt"></i>
                        </td>
                    </tr>
                    <tr>
                        <td>Budi Santoso</td>
                        <td>Hipertensi</td>
                        <td class="actions">
                            <i class="fas fa-edit"></i>
                            <i class="fas fa-trash-alt"></i>
                        </td>
                    </tr>
                    <tr>
                        <td>Clara Permata</td>
                        <td>Gastritis kronis</td>
                        <td class="actions">
                            <i class="fas fa-edit"></i>
                            <i class="fas fa-trash-alt"></i>
                        </td>
                    </tr>
                    <tr>
                        <td>Dian Kurniawan</td>
                        <td>Diabetes tipe 2</td>
                        <td class="actions">
                            <i class="fas fa-edit"></i>
                            <i class="fas fa-trash-alt"></i>
                        </td>
                    </tr>
                    <tr>
                        <td>Eliza Surya</td>
                        <td>Osteoarthritis</td>
                        <td class="actions">
                            <i class="fas fa-edit"></i>
                            <i class="fas fa-trash-alt"></i>
                        </td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
</body>

</html>
