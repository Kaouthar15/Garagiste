<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Data PDF</title>
    <style>
        body {
            font-family: 'Roboto', sans-serif;
            font-size: 16px;
            color: #333;
        }

        .container {
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
            background-color: #f9f9f9;
            border: 1px solid #ccc;
            border-radius: 10px;
        }

        h1 {
            text-align: center;
            color: #007bff;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }

        th, td {
            border: 1px solid #ccc;
            padding: 10px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
            font-weight: bold;
        }

        /* Add alternate row background color */
        tr:nth-child(even) {
            background-color: #f9f9f9;
        }
    </style>
</head>
<body>
    <div class="container">
            <h1>Vehicle Information</h1>

            <table class="vehicle-info">
                <thead>
                    <tr>
                        <th>Make</th>
                        <th>Model</th>
                        <th>Fuel Type</th>
                        <th>Registration</th>
                        <th>Client Phone Number:</th>
                    </tr>
                </thead>
                <tbody>
                        <tr>
                            <td>{{  $vehicleData['make'] }}</td> 
                            <td>{{  $vehicleData['model'] }}</td>
                            <td>{{  $vehicleData['fuelType'] }}</td>
                            <td>{{  $vehicleData['registration'] }}</td>
                            <td>{{  $vehicleData['Client_PhoneNumber'] }}</td>
                        </tr>
                </tbody>
            </table>
    </div>
</body>
</html>
