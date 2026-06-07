* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

:root {
    --bg: #aeb6c2;
    --panel: #f8fafc;
    --card: #ffffff;
    --line: #d5dce5;
    --text: #0f172a;
    --muted: #64748b;
    --blue: #17a7ee;
    --green: #22c55e;
    --yellow: #f6c21a;
    --orange: #f59e0b;
    --danger: #dc2626;
    --radius: 12px;
}

body {
    min-height: 100vh;
    font-family: Arial, Helvetica, sans-serif;
    background: var(--bg);
    color: var(--text);
    padding: 22px;
}

button,
input,
textarea,
select {
    font-family: inherit;
}

.app-shell {
    max-width: 1640px;
    min-height: calc(100vh - 44px);
    margin: 0 auto;
    background: var(--panel);
    border: 1px solid #cbd5e1;
    border-radius: 14px;
    overflow: hidden;
    box-shadow: 0 30px 80px rgba(15, 23, 42, .22);
}

.topbar {
    height: 98px;
    padding: 24px 26px;
    background: #fff;
    border-bottom: 1px solid var(--line);
    display: flex;
    justify-content: space-between;
    align-items: center;
    gap: 22px;
}

.brand-line {
    display: flex;
    align-items: center;
    gap: 10px;
}

.brand-line h1 {
    font-size: 24px;
    letter-spacing: .3px;
}

.tag {
    padding: 6px 12px;
    border: 1px solid var(--orange);
    border-radius: 999px;
    color: #a65f00;
    font-size: 12px;
    text-transform: uppercase;
    letter-spacing: 2px;
}

.topbar p {
    margin-top: 8px;
    color: var(--muted);
    font-size: 13px;
    text-transform: uppercase;
    letter-spacing: 3px;
}

.topbar-info {
    text-align: right;
}

.topbar-info p {
    text-transform: none;
    letter-spacing: 0;
    font-size: 12px;
    line-height: 1.2;
}

.main-grid {
    display: grid;
    grid-template-columns: 620px 1fr;
    min-height: calc(100vh - 186px);
}

.sidebar {
    padding: 24px 18px;
    border-right: 1px solid var(--line);
    display: flex;
    flex-direction: column;
    gap: 18px;
}

.section-title h2,
.summary-title h3 {
    font-size: 17px;
    text-transform: uppercase;
    letter-spacing: 3px;
    color: #475569;
}

.section-title p {
    margin-top: 8px;
    font-size: 13px;
    color: #475569;
    line-height: 1.4;
}

.filters {
    display: flex;
    flex-wrap: wrap;
    gap: 8px;
}

.filter-btn {
    border: 1px solid var(--line);
    background: #fff;
    color: #475569;
    padding: 7px 13px;
    border-radius: 999px;
    cursor: pointer;
    font-size: 13px;
    transition: .2s;
}

.filter-btn.active,
.filter-btn:hover {
    border-color: var(--orange);
    color: #9a5a00;
    background: #fff9e8;
}

.dot {
    width: 8px;
    height: 8px;
    border-radius: 50%;
    display: inline-block;
    margin-right: 6px;
}

.dot-all {
    background: #cbd5e1;
}

.dot-blue {
    background: var(--blue);
}

.dot-green {
    background: var(--green);
}

.dot-yellow {
    background: var(--yellow);
}

.process-list {
    height: 610px;
    overflow-y: auto;
    border: 1px solid var(--line);
    border-radius: var(--radius);
    padding: 8px;
    background: #f1f5f9;
}

.process-item {
    width: 100%;
    border: 1px solid #dbe2ea;
    background: #fff;
    border-radius: 9px;
    padding: 16px 14px;
    margin-bottom: 8px;
    cursor: pointer;
    transition: .2s;
    text-align: left;
}

.process-item.active {
    background: #fff9e8;
    border-color: var(--orange);
}

.process-item:hover {
    transform: translateY(-1px);
    border-color: var(--orange);
}

.process-top {
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 12px;
}

.process-date {
    font-size: 17px;
    font-weight: 700;
}

.process-name {
    margin-top: 12px;
    color: #475569;
    font-size: 13px;
}

.process-update {
    margin-top: 7px;
    text-align: right;
    color: #475569;
    font-size: 13px;
}

.badge {
    display: inline-flex;
    align-items: center;
    gap: 6px;
    padding: 6px 12px;
    border-radius: 999px;
    font-size: 12px;
    text-transform: uppercase;
    letter-spacing: 1.4px;
    border: 1px solid #d5dce5;
    color: #475569;
    background: #f8fafc;
}

.badge::before {
    content: "";
    width: 8px;
    height: 8px;
    border-radius: 50%;
    background: #cbd5e1;
}

.badge.em-andamento {
    border-color: var(--blue);
    color: #0369a1;
    background: #eaf7ff;
}

.badge.em-andamento::before {
    background: var(--blue);
}

.badge.baixado {
    border-color: var(--green);
    color: #15803d;
    background: #ecfdf3;
}

.badge.baixado::before {
    background: var(--green);
}

.badge.reprotocolo {
    border-color: var(--yellow);
    color: #9a5a00;
    background: #fff9e8;
}

.badge.reprotocolo::before {
    background: var(--yellow);
}

.badge.soft::before {
    display: none;
}

.legend {
    display: flex;
    gap: 14px;
    color: #64748b;
    font-size: 12px;
}

.content {
    padding: 26px 24px;
}

.content-head {
    display: flex;
    align-items: flex-start;
    justify-content: space-between;
    gap: 20px;
    margin-bottom: 20px;
}

.content-head h2 {
    font-size: 20px;
}

.content-head p {
    margin-top: 8px;
    font-size: 13px;
    color: var(--muted);
}

.last-update {
    text-align: right;
    color: var(--muted);
    font-size: 13px;
}

.last-update strong {
    display: block;
    color: var(--text);
    margin-top: 4px;
}

.summary-card,
.org-card {
    background: var(--card);
    border: 1px solid var(--line);
    border-radius: var(--radius);
    padding: 16px;
    margin-bottom: 14px;
}

.summary-title {
    display: flex;
    align-items: center;
    gap: 10px;
    margin-bottom: 12px;
}

.summary-title h3 {
    font-size: 15px;
    color: var(--text);
    letter-spacing: 0;
    text-transform: none;
}

.summary-title span {
    font-size: 13px;
    color: var(--muted);
    text-transform: uppercase;
    letter-spacing: 2px;
    font-weight: 700;
}

.status-row {
    display: flex;
    flex-wrap: wrap;
    gap: 8px;
    margin-bottom: 12px;
}

.summary-card p,
.org-box p {
    color: var(--muted);
    font-size: 13px;
    line-height: 1.6;
}

.org-grid {
    display: grid;
    grid-template-columns: repeat(2, 1fr);
    gap: 12px;
}

.org-box {
    background: #f8fafc;
    border: 1px solid #dbe2ea;
    border-radius: 9px;
    padding: 14px;
    min-height: 96px;
}

.org-box-head {
    display: flex;
    justify-content: space-between;
    gap: 12px;
    align-items: flex-start;
    margin-bottom: 10px;
}

.org-box h4 {
    font-size: 14px;
    letter-spacing: 1.8px;
    text-transform: uppercase;
}

.org-status {
    color: #b26b00;
    border: 1px solid var(--yellow);
    background: #fff9e8;
    padding: 6px 10px;
    border-radius: 999px;
    font-size: 12px;
    white-space: nowrap;
}

footer {
    height: 48px;
    border-top: 1px solid var(--line);
    display: flex;
    align-items: center;
    justify-content: flex-end;
    padding: 0 26px;
    color: #64748b;
    font-size: 12px;
}

/* LOGIN */

.login-body {
    display: flex;
    align-items: center;
    justify-content: center;
}

.login-card {
    width: 100%;
    max-width: 430px;
    background: #fff;
    border-radius: 16px;
    padding: 32px;
    box-shadow: 0 30px 80px rgba(15, 23, 42, .22);
}

.login-card h1 {
    font-size: 26px;
}

.login-card p {
    margin-top: 8px;
    color: var(--muted);
    line-height: 1.5;
}

.login-card form {
    margin-top: 24px;
    display: grid;
    gap: 16px;
}

label {
    display: grid;
    gap: 7px;
    font-size: 13px;
    font-weight: 700;
    color: #334155;
}

input,
textarea,
select {
    width: 100%;
    border: 1px solid var(--line);
    border-radius: 10px;
    padding: 12px;
    outline: none;
    background: #fff;
    color: var(--text);
}

input:focus,
textarea:focus,
select:focus {
    border-color: var(--orange);
}

.login-card button,
.form-buttons button,
.admin-box-title button,
.admin-actions button,
.admin-actions a {
    border: 0;
    background: var(--orange);
    color: #fff;
    padding: 12px 16px;
    border-radius: 10px;
    cursor: pointer;
    font-weight: 700;
    text-decoration: none;
    display: inline-flex;
    align-items: center;
    justify-content: center;
}

.login-card small {
    display: block;
    margin-top: 18px;
    color: var(--muted);
}

/* ADMIN */

.admin-shell {
    max-width: 1400px;
    margin: 0 auto;
}

.admin-header {
    background: #fff;
    border-radius: 16px;
    padding: 22px;
    margin-bottom: 18px;
    display: flex;
    justify-content: space-between;
    gap: 20px;
    align-items: center;
    border: 1px solid var(--line);
}

.admin-header p {
    margin-top: 6px;
    color: var(--muted);
}

.admin-actions {
    display: flex;
    gap: 10px;
}

.admin-actions button {
    background: #334155;
}

.admin-grid {
    display: grid;
    grid-template-columns: 390px 1fr;
    gap: 18px;
}

.admin-list-area,
.form-area {
    background: #fff;
    border: 1px solid var(--line);
    border-radius: 16px;
    padding: 18px;
}

.admin-box-title {
    display: flex;
    justify-content: space-between;
    gap: 12px;
    align-items: center;
    margin-bottom: 14px;
}

.admin-box-title h2,
.form-title h2 {
    font-size: 20px;
}

.admin-process-list {
    display: grid;
    gap: 8px;
    max-height: 720px;
    overflow-y: auto;
}

.admin-process-item {
    border: 1px solid var(--line);
    border-radius: 10px;
    padding: 13px;
    background: #f8fafc;
    cursor: pointer;
}

.admin-process-item.active {
    border-color: var(--orange);
    background: #fff9e8;
}

.form-title {
    margin-bottom: 18px;
}

.form-title p {
    margin-top: 6px;
    color: var(--muted);
}

#processForm {
    display: grid;
    gap: 16px;
}

.form-row {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 14px;
}

.org-form-title {
    margin-top: 8px;
    font-size: 18px;
}

.admin-org-fields {
    display: grid;
    grid-template-columns: repeat(2, 1fr);
    gap: 14px;
}

.admin-org-box {
    border: 1px solid var(--line);
    background: #f8fafc;
    border-radius: 12px;
    padding: 14px;
    display: grid;
    gap: 10px;
}

.form-buttons {
    display: flex;
    gap: 10px;
    margin-top: 8px;
}

.form-buttons .danger {
    background: var(--danger);
}

@media (max-width: 1100px) {
    body {
        padding: 12px;
    }

    .topbar {
        height: auto;
        align-items: flex-start;
        flex-direction: column;
    }

    .topbar-info {
        text-align: left;
    }

    .main-grid,
    .admin-grid {
        grid-template-columns: 1fr;
    }

    .sidebar {
        border-right: 0;
        border-bottom: 1px solid var(--line);
    }

    .process-list {
        height: 420px;
    }

    .admin-org-fields,
    .org-grid {
        grid-template-columns: 1fr;
    }
}

@media (max-width: 640px) {
    body {
        padding: 0;
        background: var(--panel);
    }

    .app-shell {
        min-height: 100vh;
        border-radius: 0;
        border: 0;
    }

    .brand-line {
        align-items: flex-start;
        flex-direction: column;
    }

    .brand-line h1 {
        font-size: 20px;
    }

    .topbar p {
        letter-spacing: 1.4px;
    }

    .content-head,
    .summary-title,
    .admin-header,
    .form-buttons {
        flex-direction: column;
    }

    .last-update {
        text-align: left;
    }

    .form-row {
        grid-template-columns: 1fr;
    }

    .admin-actions {
        width: 100%;
        flex-direction: column;
    }

    .admin-actions a,
    .admin-actions button,
    .form-buttons button {
        width: 100%;
    }
}


.alert-error {
    margin-top: 18px;
    padding: 12px;
    border-radius: 10px;
    background: #fee2e2;
    color: #991b1b;
    border: 1px solid #fecaca;
    font-size: 14px;
}

.admin-process-item {
    color: inherit;
    text-decoration: none;
}

.admin-actions .dark-btn {
    background: #334155;
}

.danger-link {
    background: var(--danger);
    color: #fff;
    padding: 12px 16px;
    border-radius: 10px;
    text-decoration: none;
    font-weight: 700;
}

.empty-message {
    color: #64748b;
    padding: 18px;
}
