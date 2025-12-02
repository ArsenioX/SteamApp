<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Gaming Store - Receipt</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap');

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', sans-serif;
            background: #7a7690;
            color: #ffffff;
            min-height: 100vh;
            padding: 20px;
        }

        .receipt {
            max-width: 480px;
            margin: 0 auto;
            background: #1a1a1a;
            border-radius: 16px;
            overflow: hidden;
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.5);
        }

        .header {
            background: linear-gradient(135deg, #6366f1, #8b5cf6);
            padding: 32px 24px;
            text-align: center;
        }

        .logo {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 12px;
            margin-bottom: 16px;
        }

        .logo-icon {
            width: 40px;
            height: 40px;
            background: rgba(255, 255, 255, 0.2);
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .logo-text {
            font-size: 24px;
            font-weight: 700;
            color: #ffffff;
            letter-spacing: -0.5px;
        }

        .receipt-title {
            font-size: 16px;
            font-weight: 500;
            color: rgba(255, 255, 255, 0.8);
            margin-bottom: 8px;
        }

        .receipt-number {
            font-size: 14px;
            font-weight: 600;
            color: #ffffff;
            background: rgba(255, 255, 255, 0.1);
            padding: 8px 16px;
            border-radius: 20px;
            display: inline-block;
        }

        .content {
            padding: 32px 24px;
        }

        .section {
            margin-bottom: 32px;
        }

        .section:last-child {
            margin-bottom: 0;
        }

        .section-title {
            font-size: 14px;
            font-weight: 600;
            color: #a1a1aa;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            margin-bottom: 16px;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .product-card {
            background: #262626;
            border-radius: 12px;
            padding: 20px;
            border: 1px solid #404040;
        }

        .product-icon {
            width: 48px;
            height: 48px;
            background: linear-gradient(135deg, #6366f1, #8b5cf6);
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 12px;
        }

        .product-name {
            font-size: 16px;
            font-weight: 600;
            color: #ffffff;
            margin-bottom: 4px;
        }

        .product-code {
            font-size: 14px;
            color: #a1a1aa;
            font-family: 'SF Mono', Monaco, monospace;
        }

        .info-grid {
            display: grid;
            gap: 16px;
        }

        .info-item {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 12px 0;
            border-bottom: 1px solid #404040;
        }

        .info-item:last-child {
            border-bottom: none;
        }

        .info-label {
            font-size: 14px;
            color: #a1a1aa;
            font-weight: 500;
        }

        .info-value {
            font-size: 14px;
            color: #ffffff;
            font-weight: 600;
            text-align: right;
        }

        .status {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 6px 12px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .status-success {
            background: #10b981;
            color: #ffffff;
        }

        .status-pending {
            background: #f59e0b;
            color: #ffffff;
        }

        .status-failed {
            background: #ef4444;
            color: #ffffff;
        }

        .total-section {
            background: #262626;
            border-radius: 12px;
            padding: 24px;
            text-align: center;
            border: 1px solid #404040;
        }

        .total-label {
            font-size: 14px;
            color: #a1a1aa;
            margin-bottom: 8px;
            font-weight: 500;
        }

        .total-amount {
            font-size: 32px;
            font-weight: 700;
            color: #ffffff;
            letter-spacing: -1px;
        }

        .footer {
            background: #111111;
            padding: 24px;
            text-align: center;
            border-top: 1px solid #262626;
        }

        .footer-text {
            font-size: 12px;
            color: #71717a;
            line-height: 1.5;
            margin-bottom: 8px;
        }

        .footer-text:last-child {
            margin-bottom: 0;
        }

        .highlight {
            color: #6366f1;
            font-weight: 600;
        }

        /* Icons */
        .icon {
            width: 16px;
            height: 16px;
            fill: currentColor;
        }

        @media (max-width: 480px) {
            .receipt {
                margin: 0;
                border-radius: 0;
                min-height: 100vh;
            }

            body {
                padding: 0;
            }
        }

        @media print {
            body {
                background: white;
                color: rgb(154, 154, 156);
                -webkit-print-color-adjust: exact;
                print-color-adjust: exact;
            }
        }
    </style>
</head>

<body>
    <div class="receipt">
        <div class="header">
            <div class="logo">
                <div class="logo-icon">
                    <svg class="icon" viewBox="0 0 24 24" fill="white">
                        <path
                            d="M21,6H3C2.4,6,2,6.4,2,7v10c0,0.6,0.4,1,1,1h18c0.6,0,1-0.4,1-1V7C22,6.4,21.6,6,21,6z M20,16H4V8h16V16z M8,10H6v2h2V10z M8,13H6v2h2V13z M11,10H9v2h2V10z M11,13H9v2h2V13z M18,10h-2v2h2V10z M18,13h-2v2h2V13z" />
                    </svg>
                </div>
                <div class="logo-text">GameStore</div>
            </div>
            <div class="receipt-title">Digital Receipt</div>
            <div class="receipt-number">#{{ strtoupper(substr(md5($transaksi->kode_produk), 0, 8)) }}</div>
        </div>

        <div class="content">
            <div class="section">
                <div class="section-title">
                    <svg class="icon" viewBox="0 0 24 24" fill="currentColor">
                        <path
                            d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-2 15l-5-5 1.41-1.41L10 14.17l7.59-7.59L19 8l-9 9z" />
                    </svg>
                    Product
                </div>
                <div class="product-card">
                    <div class="product-icon">
                        <svg class="icon" viewBox="0 0 24 24" fill="white">
                            <path
                                d="M21,6H3C2.4,6,2,6.4,2,7v10c0,0.6,0.4,1,1,1h18c0.6,0,1-0.4,1-1V7C22,6.4,21.6,6,21,6z M20,16H4V8h16V16z M8,10H6v2h2V10z M8,13H6v2h2V13z M11,10H9v2h2V10z M11,13H9v2h2V13z M18,10h-2v2h2V10z M18,13h-2v2h2V13z" />
                        </svg>
                    </div>
                    <div class="product-name">Game</div>
                    <div class="product-code">{{ $transaksi->kode_produk }}</div>
                </div>
            </div>

            <div class="section">
                <div class="section-title">
                    <svg class="icon" viewBox="0 0 24 24" fill="currentColor">
                        <path
                            d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z" />
                    </svg>
                    Details
                </div>
                <div class="info-grid">
                    <div class="info-item">
                        <span class="info-label">Customer</span>
                        <span class="info-value">{{ $transaksi->nama_user }}</span>
                    </div>
                    <div class="info-item">
                        <span class="info-label">Status</span>
                        <span class="info-value">
                            @if($transaksi->status == 'Selesai')
                                <span class="status status-success">
                                    <svg class="icon" viewBox="0 0 24 24" fill="currentColor">
                                        <path d="M9 16.17L4.83 12l-1.42 1.41L9 19 21 7l-1.41-1.41z" />
                                    </svg>
                                    Completed
                                </span>
                            @elseif($transaksi->status == 'Pending')
                                <span class="status status-pending">
                                    <svg class="icon" viewBox="0 0 24 24" fill="currentColor">
                                        <path
                                            d="M12,2A10,10 0 0,0 2,12A10,10 0 0,0 12,22A10,10 0 0,0 22,12A10,10 0 0,0 12,2M12,17A5,5 0 0,1 7,12A5,5 0 0,1 12,7A5,5 0 0,1 17,12A5,5 0 0,1 12,17M12,9A3,3 0 0,0 9,12A3,3 0 0,0 12,15A3,3 0 0,0 15,12A3,3 0 0,0 12,9Z" />
                                    </svg>
                                    Pending
                                </span>
                            @else
                                <span class="status status-failed">
                                    <svg class="icon" viewBox="0 0 24 24" fill="currentColor">
                                        <path
                                            d="M19,6.41L17.59,5L12,10.59L6.41,5L5,6.41L10.59,12L5,17.59L6.41,19L12,13.41L17.59,19L19,17.59L13.41,12L19,6.41Z" />
                                    </svg>
                                    {{ $transaksi->status }}
                                </span>
                            @endif
                        </span>
                    </div>
                    <div class="info-item">
                        <span class="info-label">Date</span>
                        <span
                            class="info-value">{{ \Carbon\Carbon::parse($transaksi->created_at)->format('d M Y, H:i') }}
                            WIB</span>
                    </div>
                </div>
            </div>

            <div class="section">
                <div class="total-section">
                    <div class="total-label">Total Payment</div>
                    <div class="total-amount">Rp {{ number_format($transaksi->harga, 0, ',', '.') }}</div>
                </div>
            </div>
        </div>

        <div class="footer">
            <div class="footer-text">
                Thank you for choosing <span class="highlight">GameStore</span>
            </div>
            <div class="footer-text">
                This is an automatically generated digital receipt
            </div>
            <div class="footer-text">
                support@gamestore.com • www.gamestore.com
            </div>
        </div>
    </div>
</body>

</html>