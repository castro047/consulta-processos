const ORGAOS_PADRAO = [
    "Boa Vista",
    "Cenprot Nacional",
    "Cenprot SP",
    "Serasa",
    "SPC",
    "Status Geral"
];

let processos = window.PROCESSOS_BANCO || [];
let filtroAtual = "todos";
let processoSelecionado = processos[0] || null;

const processList = document.getElementById("processList");
const orgGrid = document.getElementById("orgGrid");
const selectedTitle = document.getElementById("selectedTitle");
const selectedUpdate = document.getElementById("selectedUpdate");
const selectedStatusBadge = document.getElementById("selectedStatusBadge");
const selectedCodeBadge = document.getElementById("selectedCodeBadge");
const selectedSummary = document.getElementById("selectedSummary");
const filterButtons = document.querySelectorAll(".filter-btn");

function formatStatusClass(status) {
    if (status === "em andamento") return "em-andamento";
    if (status === "100% baixado") return "baixado";
    if (status === "reprotocolo") return "reprotocolo";
    return "";
}

function formatStatusLabel(status) {
    if (status === "em andamento") return "Em andamento";
    if (status === "100% baixado") return "100% baixado";
    if (status === "reprotocolo") return "Reprotocolo";
    return status;
}

function formatarDataBanco(dataBanco) {
    if (!dataBanco) return "--/--/---- às --:--";

    const data = new Date(dataBanco.replace(" ", "T"));

    if (isNaN(data.getTime())) return dataBanco;

    return data.toLocaleDateString("pt-BR") + " às " + data.toLocaleTimeString("pt-BR", {
        hour: "2-digit",
        minute: "2-digit"
    });
}

function preencherOrgaosVazios(orgaos) {
    return ORGAOS_PADRAO.map(function(nomeOrgao) {
        const encontrado = orgaos.find(function(item) {
            return item.nome === nomeOrgao;
        });

        if (encontrado) return encontrado;

        return {
            nome: nomeOrgao,
            status: "Aguardando início das baixas",
            descricao: "As informações detalhadas sobre este órgão serão atualizadas aqui pela coordenação."
        };
    });
}

function renderProcessos() {
    processList.innerHTML = "";

    const listaFiltrada = processos.filter(function(processo) {
        if (filtroAtual === "todos") return true;
        return processo.status === filtroAtual;
    });

    if (listaFiltrada.length === 0) {
        processList.innerHTML = "<p class='empty-message'>Nenhum processo encontrado.</p>";
        return;
    }

    listaFiltrada.forEach(function(processo) {
        const item = document.createElement("button");
        item.className = "process-item";

        if (processoSelecionado && processoSelecionado.id === processo.id) {
            item.classList.add("active");
        }

        item.innerHTML = `
            <div class="process-top">
                <strong class="process-date">${processo.data_lista}</strong>
                <span class="badge ${formatStatusClass(processo.status)}">${formatStatusLabel(processo.status)}</span>
            </div>
            <div class="process-name">${processo.nome}</div>
            <div class="process-update">${formatarDataBanco(processo.atualizado_em)}</div>
        `;

        item.addEventListener("click", function() {
            processoSelecionado = processo;
            renderProcessos();
            renderDetalhes();
        });

        processList.appendChild(item);
    });
}

function renderDetalhes() {
    if (!processoSelecionado) return;

    selectedTitle.textContent = "Lista " + processoSelecionado.data_lista;
    selectedUpdate.textContent = formatarDataBanco(processoSelecionado.atualizado_em);

    selectedStatusBadge.className = "badge " + formatStatusClass(processoSelecionado.status);
    selectedStatusBadge.textContent = formatStatusLabel(processoSelecionado.status);

    selectedCodeBadge.textContent = "Processo coletivo · Lista " + processoSelecionado.data_lista;

    selectedSummary.textContent = processoSelecionado.resumo || "Sem resumo cadastrado.";

    const orgaos = preencherOrgaosVazios(processoSelecionado.orgaos || []);

    orgGrid.innerHTML = "";

    orgaos.forEach(function(orgao) {
        const box = document.createElement("div");
        box.className = "org-box";

        box.innerHTML = `
            <div class="org-box-head">
                <h4>${orgao.nome}</h4>
                <span class="org-status">${orgao.status || "Sem status"}</span>
            </div>
            <p>${orgao.descricao || "Sem descrição cadastrada."}</p>
        `;

        orgGrid.appendChild(box);
    });
}

filterButtons.forEach(function(btn) {
    btn.addEventListener("click", function() {
        filterButtons.forEach(function(item) {
            item.classList.remove("active");
        });

        btn.classList.add("active");
        filtroAtual = btn.dataset.filter;
        renderProcessos();
    });
});

renderProcessos();
renderDetalhes();
