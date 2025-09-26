<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Inventaris Barang</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- DataTables CSS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/jquery.dataTables.min.css">
    <!-- DataTables Buttons CSS (untuk export Excel, PDF, Print) -->
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.4.2/css/buttons.dataTables.min.css">

    <style>
        /* --- Global --- */
        body {
            display: flex;
            flex-direction: column;
            min-height: 100vh;
            font-family: 'Segoe UI', sans-serif;
            background: #f8f9fa;
        }

        .wrapper {
            display: flex;
            flex: 1;
            transition: all 0.3s ease;
        }

        /* --- Sidebar --- */
        .sidebar {
            min-width: 220px;
            max-width: 220px;
            background: linear-gradient(180deg, #084127ff, #06341f);
            color: #fff;
            transition: all 0.3s ease;
            overflow: hidden;
        }

        .sidebar.collapsed {
            width: 0;
            min-width: 0;
        }

        .sidebar h4 {
            text-align: left;
            padding: 20px;
            margin: 0;
            font-size: 1.2rem;
            border-bottom: 1px solid rgba(255, 255, 255, 0.25);
        }

        .sidebar a {
            color: #fff;
            text-decoration: none;
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 12px 20px;
            font-size: 0.95rem;
            border-radius: 6px;
            margin: 4px 10px;
            transition: 0.3s;
        }

        .sidebar a:hover {
            background-color: rgba(255, 255, 255, 0.2);
            transform: translateX(5px);
        }

        .sidebar a.active {
            background-color: rgba(255, 255, 255, 0.2);
        }

        /* --- Content --- */
        .content {
            flex: 1;
            padding: 25px;
            transition: margin-left 0.3s ease;
        }

        .card {
            border: none;
            border-radius: 15px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
        }

        .card-body {
            padding: 25px;
        }

        /* --- Tabel --- */
        table th,
        table td {
            vertical-align: middle;
        }

        .table-custom thead {
            background: #084127ff;
            color: #fff;
        }

        /* --- Footer --- */
        footer {
            background: #084127ff;
            color: #fff;
            padding: 12px;
            text-align: center;
            font-size: 0.9rem;
        }

        @media (max-width: 768px) {
            .sidebar {
                position: absolute;
                z-index: 999;
                height: 100%;
                left: -220px;
            }

            .sidebar.collapsed {
                left: 0;
            }
        }

        .bg-success {
            background-color: #084127ff !important;
        }

        .text-success {
            color: #084127ff !important;
        }

        .btn-success {
            background-color: #084127ff !important;
            border-color: #084127ff !important;
        }

        .btn-success:hover {
            background-color: #06341f !important;
            border-color: #06341f !important;
        }

        .table-success {
            background-color: #084127ff !important;
            color: #fff !important;
        }
    </style>
</head>

<body>
