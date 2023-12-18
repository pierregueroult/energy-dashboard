function getStoredDepartment() {
  let department = localStorage.getItem("department");
  return department ? department : "gard";
}

async function loadYearlyCharts(department, year) {
  // first chart
  var res = await fetch(
    "/sae303/api/charts/consoType.php?department=" +
      department +
      "&year=" +
      year,
  );
  var { data } = await res.json();

  drawConsoType(data);

  // second chart
  var res = await fetch(
    "/sae303/api/charts/topOperator.php?department=" +
      department +
      "&year=" +
      year,
  );

  var { data } = await res.json();

  createTopOperatorList(data);
}

async function loadCharts(department) {
  // test if the department is stored before anything
  try {
    const res = await fetch("/sae303/api/test.php?department=" + department);
    const { status } = await res.json();
    if (status === false) {
      throw new Error("The department is not available");
    }
  } catch (e) {
    window.alert(
      "Il semblerait que toutes les bases de données nécessaires ne soient pas disponibles ... ",
    );
    return;
  }

  // load cards
  const cards = document.querySelectorAll("[data-cards]");
  cards.forEach(async (card, i) => {
    // get all the elements
    const legend = card.querySelector("dt");
    const value = card.querySelector("dd");
    const aside = card.querySelector("aside");
    const ratio = card.querySelector("span");
    const svg = card.querySelectorAll("svg");

    // get the data
    const res = await fetch(
      `/sae303/api/cards?department=${department}&index=${i + 1}`,
    );

    const { data } = await res.json();

    aside.classList.remove(
      "positive",
      "negative",
      "text-green-500",
      "text-red-500",
    );

    // insert the data
    legend.innerText = data.legend;
    value.innerText = Math.round(data.info) + " " + data.unit;
    ratio.innerText = Math.round(data.ratio * 100) / 100 + "%";

    // set the svg
    aside.classList.add(data.ratio > 0 ? "positive" : "negative");
    aside.classList.add(data.ratio > 0 ? "text-green-500" : "text-red-500");

    // toggle the visibility
    legend.classList.remove("-translate-y-2", "opacity-0");
    value.classList.remove("translate-y-2", "opacity-0");
    ratio.classList.remove("translate-y-2", "opacity-0");
    svg.forEach((s) => s.classList.remove("-translate-y-2", "opacity-0"));
  });
  // load charts

  // first chart
  var res = await fetch(
    "/sae303/api/charts/consoByYear.php?department=" + department,
  );
  var { data } = await res.json();

  drawConsoByYear(data);

  await loadYearlyCharts(department, 2021);

  // second chart
  var res = await fetch(
    "/sae303/api/charts/typeOfProduction.php?department=" + department,
  );

  var { data } = await res.json();

  drawTypeOfProduction(data);

  // third chart
  var res = await fetch(
    "/sae303/api/charts/regionByMonth.php?department=" + department,
  );
  var { data } = await res.json();

  drawRegionByMonth(data);

  // fourth chart
  var res = await fetch(
    "/sae303/api/charts/prodByMonth.php?department=" + department,
  );
  var { data } = await res.json();

  drawProdByMonth(data);
}

function drawTypeOfProduction(data) {
  let canva = document.getElementById("typeOfProduction");

  canva.remove();

  const container = document.getElementById("typeOfProductionContainer");

  const newCanva = document.createElement("canvas");
  newCanva.id = "typeOfProduction";
  container.insertBefore(newCanva, container.firstChild);

  const colors = [
    "#ffdd57",
    "#fed54d",
    "#fdbb43",
    "#fc9f39",
    "#fb842f",
    "#fa6825",
    "#ff3860",
  ];

  new Chart(newCanva, {
    type: "pie",
    data: {
      labels: Object.keys(data),
      datasets: [
        {
          label: "Répartition de la production",
          data: Object.values(data),
          backgroundColor: colors,
          borderWidth: 0,
          hoverOffset: 10,
          animation: {
            animateScale: true,
            animateRotate: true,
          },
        },
      ],
    },
    options: {
      plugins: {
        legend: {
          // position: "right",
          display: false,
        },
      },
      responsive: true,
    },
  });

  const legend = document.querySelector("#typeOfProductionContainer > ul");
  legend.innerHTML = "";
  Object.keys(data).forEach((key, i) => {
    const li = document.createElement("li");
    li.innerHTML = `<span class="inline-block w-4 h-4 mr-2 rounded-full" style="background-color: ${colors[i]};"></span>${key}`;
    li.classList.add("text-text");
    legend.appendChild(li);
  });
}

function drawConsoByYear(data) {
  // get the seleted data by the buttons
  // const buttons = document.querySelectorAll("[data-conso]");
  const datalist = [["Consommation totale", "#000000"]];
  // drow the chart
  let canva = document.getElementById("consoByYear");

  canva.remove();

  const container = document.getElementById("consoByYearContainer");

  const newCanva = document.createElement("canvas");
  newCanva.id = "consoByYear";
  container.appendChild(newCanva);

  new Chart(newCanva, {
    type: "line",
    data: {
      labels: data.map((d) => d["Année"]),
      datasets: datalist.map((list) => ({
        label: list[0] + " (MWh)",
        data: data.map((d) => d["SUM(`" + list[0] + " (MWh)`)"]),
        borderColor: list[1],
        pointBackgroundColor: list[1],
        borderWidth: 3,
        fill: false,
        pointRadius: 2,
        tension: 0.3,
        drawActiveElementsOnTop: true,
      })),
    },
    options: {
      plugins: {
        legend: {
          display: false,
        },
      },
      scales: {
        y: {
          grid: {
            display: false,
          },
          // ticks: {
          //   callback: (value) => value / 1000,
          // },
        },
      },
    },
  });
}

async function triggerConsoByYear(e) {
  e.classList.toggle("bg-black");
  e.classList.toggle("text-white");

  const department = getStoredDepartment();

  const buttons = document.querySelectorAll("[data-conso]");
  const datalist = [];
  buttons.forEach((b) => {
    if (b.classList.contains("bg-black")) {
      datalist.push([b.innerText, b.dataset.color]);
    }
  });

  const res = await fetch(
    "/sae303/api/charts/consoByYear.php?department=" + department,
  );
  var { data } = await res.json();

  let canva = document.getElementById("consoByYear");

  // we reset the chart
  canva.remove();

  const container = document.getElementById("consoByYearContainer");

  const newCanva = document.createElement("canvas");
  newCanva.id = "consoByYear";
  container.appendChild(newCanva);

  const formatedData = data.map((d) => ({
    ...d,
    "SUM(`Consommation Tertiaire (MWh)`)":
      d["SUM(`Consommation Tertiaire  (MWh)`)"],
    "SUM(`Consommation Résidentiel (MWh)`)":
      d["SUM(`Consommation Résidentiel  (MWh)`)"],
  }));

  console.log(formatedData);

  new Chart(newCanva, {
    type: "line",
    data: {
      labels: data.map((d) => d["Année"]),
      datasets: datalist.map((list) => ({
        label: list[0] + " (MWh)",
        data: formatedData.map((d) => d["SUM(`" + list[0] + " (MWh)`)"]),
        borderColor: list[1],
        pointBackgroundColor: list[1],
        borderWidth: 3,
        fill: false,
        pointRadius: 2,
        tension: 0.3,
        drawActiveElementsOnTop: true,
      })),
    },
    options: {
      plugins: {
        legend: {
          display: false,
        },
      },
      scales: {
        y: {
          grid: {
            display: false,
          },
        },
      },
    },
  });
}

document.addEventListener("DOMContentLoaded", () => {
  loadCharts("gard");
});

function drawRegionByMonth(data) {
  let canva = document.getElementById("regionByMonth");

  canva.remove();

  const container = document.getElementById("regionByMonthContainer");

  const newCanva = document.createElement("canvas");
  newCanva.id = "regionByMonth";
  container.appendChild(newCanva);

  new Chart(newCanva, {
    type: "bar",
    data: {
      labels: [
        "Janvier",
        "Février",
        "Mars",
        "Avril",
        "Mai",
        "Juin",
        "Juillet",
        "Août",
        "Septembre",
        "Octobre",
        "Novembre",
        "Décembre",
      ],
      datasets: [
        {
          label: "Consommation (MWh)",
          data: data.map((d) => d["Consommation"]),
          backgroundColor: "#ffdd57",
          barPercentage: 0.7,
          minBarLength: 2,
        },
        {
          label: "Production (MWh)",
          data: data.map((d) => d["Production"]),
          backgroundColor: "#ff3860",
          barPercentage: 0.7,
          minBarLength: 2,
        },
      ],
    },
    options: {
      plugins: {
        legend: {
          position: "right",
        },
      },
      scales: {
        y: {
          grid: {
            display: false,
          },
        },
      },
    },
  });
}

function drawProdByMonth(data) {
  const canva = document.getElementById("prodByMonth");
  const container = document.getElementById("prodByMonthContainer");

  canva.remove();

  const newCanva = document.createElement("canvas");
  newCanva.id = "prodByMonth";
  container.appendChild(newCanva);

  const colors = [
    "#ffdd57",
    "#fed54d",
    "#fdbb43",
    "#fc9f39",
    "#fb842f",
    "#fa6825",
    "#ff3860",
  ];

  var keys = Object.keys(data[0]);
  keys.shift("Mois");

  new Chart(newCanva, {
    type: "line",
    data: {
      labels: [
        "Janvier",
        "Février",
        "Mars",
        "Avril",
        "Mai",
        "Juin",
        "Juillet",
        "Août",
        "Septembre",
        "Octobre",
        "Novembre",
        "Décembre",
      ],
      datasets: keys.map((key, i) => ({
        label: key,
        data: data.map((d) => d[key]),
        borderColor: colors[i],
        pointBackgroundColor: colors[i],
        borderWidth: 2,
        fill: true,
        tension: 0.4,
        drawActiveElementsOnTop: true,
        pointStyle: "triangle",
      })),
    },
    options: {
      plugins: {
        legend: {
          position: "right",
        },
      },
      scales: {
        y: {
          grid: {
            display: false,
          },
        },
      },
    },
  });
}

function drawConsoType(data) {
  const canva = document.getElementById("consoType");
  const container = document.getElementById("consoTypeContainer");
  const legend = document.getElementById("consoTypeLegend");

  legend.innerHTML = "";

  canva.remove();

  const newCanva = document.createElement("canvas");
  newCanva.id = "consoType";
  container.appendChild(newCanva);

  const colors = [
    "#fed54d",
    "#fb842f",
    "#fa6825",
    "#ff3860",
    "#fc9f39",
    "#ffdd57",
  ];

  Object.keys(data[0])
    .filter((key) => (key.startsWith("C.") ? true : false))
    .map((key, i) => {
      const li = document.createElement("li");
      li.innerHTML = `<span class="inline-block w-4 h-4 mr-2 rounded-full" style="background-color: ${colors[i]};"></span>${key}`;
      li.classList.add("text-text", "text-sm", "flex", "items-center");
      legend.appendChild(li);
    });

  new Chart(newCanva, {
    type: "doughnut",
    data: {
      labels: Object.keys(data[0]).filter((key) =>
        key.startsWith("C.") ? true : false,
      ),
      datasets: [
        {
          label: "Consommation par secteur",
          data: Object.keys(data[0])
            .map((key) => (key.startsWith("C.") ? data[0][key] : false))
            .filter((d) => d !== false),
          backgroundColor: colors,
          borderWidth: 0,
        },
        {
          label: "Point de livraison par secteur",
          data: Object.keys(data[0])
            .map((key) => (key.startsWith("P.") ? data[0][key] : false))
            .filter((d) => d !== false),
          backgroundColor: colors,
          borderWidth: 0,
        },
      ],
    },
    options: {
      // responsive: true,
      plugins: {
        legend: {
          // position: "right",
          display: false,
          labels: {
            usePointStyle: true,
          },
        },
      },
    },
  });
}

function createTopOperatorList(data) {
  const list = document.getElementById("topOperatorList");

  list.innerHTML = "";

  const emojis = [
    "🥇",
    "🥈",
    "🥉",
    "🏅",
    "🏅",
    "🏅",
    "🏅",
    "🏅",
    "🏅",
    "🏅",
    "🏅",
  ];

  if (data.length > 2) {
    data = data.slice(0, 4);
  }

  data.forEach((d, i) => {
    const li = document.createElement("li");
    li.classList.add(
      "w-full",
      "text-text",
      "flex",
      "gap-4",
      "border-border",
      "border",
      "rounded",
      "items-center",
      "justify-between",
      "p-2",
    );
    const operatorSpan = document.createElement("span");
    operatorSpan.classList.add("font-bold", "text-md");
    operatorSpan.innerText = emojis[i] + " " + d["Opérateur"];
    const valueSpan = document.createElement("span");
    valueSpan.classList.add("font-bold", "text-sm");
    valueSpan.innerText = d["Somme Conso"] + " MWh";
    li.appendChild(operatorSpan);
    li.appendChild(valueSpan);

    list.appendChild(li);
  });
}
