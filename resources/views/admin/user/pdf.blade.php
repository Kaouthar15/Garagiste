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

        tr:nth-child(even) {
            background-color: #f9f9f9;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>User Data</h1>

        <table class="user-info">
            <tbody>
                <tr>
                    <th>Username</th>
                    <td>{{ $userData['username'] }}</td>
                    <th>First Name</th>
                    <td>{{ $userData['firstName'] }}</td>
                </tr>
                <tr>
                    <th>Last Name</th>
                    <td>{{ $userData['lastName'] }}</td>
                    <th>Address</th>
                    <td>{{ $userData['address'] }}</td>
                </tr>
                <tr>
                    <th>Phone Number</th>
                    <td>{{ $userData['phoneNumber'] }}</td>
                    <th>Email</th>
                    <td>{{ $userData['email'] }}</td>
                </tr>
                <tr>
                    <th>Is Client</th>
                    <td>{{ $userData['isClient'] ? 'Yes' : 'No' }}</td>
                    <th>Is Mechanic</th>
                    <td>{{ $userData['isMechanic'] ? 'Yes' : 'No' }}</td>
                </tr>
            </tbody>
        </table>

        @if (isset($userData['vehicles']) && count($userData['vehicles']) > 0)
            <h1>Vehicle Information</h1>

            <table class="vehicle-info">
                <thead>
                    <tr>
                        <th>Make</th>
                        <th>Model</th>
                        <th>Fuel Type</th>
                        <th>Registration</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($userData['vehicles'] as $vehicle)
                        <tr>
                            <td>{{ $vehicle->make }}</td>
                            <td>{{ $vehicle->model }}</td>
                            <td>{{ $vehicle->fuelType }}</td>
                            <td>{{ $vehicle->registration }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    </div>
</body>
</html>
