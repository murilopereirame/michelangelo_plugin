let totalYoutubeVideos = 0;
let totalArchitects = 0;
let totalImages = 0;
let totalImplantation = 0;
let totalAreas = 0;
let totalFromTo = 0;
let totalBlueprints = 0;

let youtubeVideos = [];
let images = [];
let architects = [];
let implantations = [];
let areas = [];
let fromTos = [];
let blueprints = [];

let update = false;
let idmop_project = -1;

const addYoutubeVideo = (id = -1) => {
  const videoURL = $("#gallery-of-videos-url").val();
  const preview = $("#gallery-of-videos-preview").val();

  if (videoURL === "") return;
  $("#youtube-list").append(`
        <div class="url-item" id="yt-video-${totalYoutubeVideos}">
          <span>${videoURL.replace("https://www.", "")}</span>
          <button class="field-button" onclick="removeYoutubeVideo(${totalYoutubeVideos}, '${videoURL}')" type="button">Remover</button>
        </div>
      `);

  $("#gallery-of-videos-url").val("");
  youtubeVideos.push({ id, url: videoURL, preview: preview });
  totalYoutubeVideos++;
};

const removeYoutubeVideo = (video_index, url) => {
  $(`#yt-video-${video_index}`).remove();
  const arrIndex = youtubeVideos.findIndex((elem) => elem.url === url);
  youtubeVideos.splice(arrIndex, 1);
};

const addImageToGallery = (id = -1) => {
  const imageURL = $("#gallery-of-images-url").val();
  const title = $("#gallery-of-images-title").val();

  if (imageURL === "") return;
  $("#image-list").append(`
        <div class="url-item" id="image-${totalImages}">
          <span>${imageURL.replace("https://www.", "")}</span>
          <button class="field-button" onclick="removeImageFromGallery(${totalImages}, '${imageURL}')" type="button">Remover</button>
        </div>
      `);

  $("#gallery-of-images-url").val("");
  images.push({ id, url: imageURL, title: title });
  totalImages++;
};

const removeImageFromGallery = (image_index, url) => {
  $(`#image-${image_index}`).remove();
  const arrIndex = images.findIndex((elem) => elem.url === url);
  images.splice(arrIndex, 1);
};

const addArchitect = (id = -1) => {
  const name = $("#architect-name").val();
  const body = $("#architect-body").val();
  const image = $("#architect-image").val();

  $("#architect-list").append(`
        <div class="url-item" id="architect-item-${totalArchitects}">
          <span>${name}</span>
          <button class="field-button" onclick="removeArchitect(${totalArchitects}, '${name}')" type="button">Remover</button>
        </div>
      `);

  totalArchitects++;

  architects.push({
    id,
    name,
    body,
    image,
  });
};

const removeArchitect = (architect_index, name) => {
  $(`#architect-item-${architect_index}`).remove();
  const arrIndex = architects.findIndex((elem) => elem.name === name);
  architects.splice(arrIndex, 1);
};

const addBlueprint = (id = -1) => {
  const title = $("#blueprint-title").val();
  const image = $("#blueprint-image").val();

  $("#blueprint-list").append(`
        <div class="url-item" id="blueprint-item-${totalBlueprints}">
          <span>${title}</span>
          <button class="field-button" onclick="removeBlueprint(${totalBlueprints}, '${title}')" type="button">Remover</button>
        </div>
      `);

  totalBlueprints++;

  blueprints.push({
    id,
    title,
    image,
  });
};

const addImplantation = (id = -1) => {
  const title = $("#implantation-title").val();
  const image = $("#implantation-image").val();

  $("#implantation-list").append(`
        <div class="url-item" id="implantation-item-${totalImplantation}">
          <span>${title}</span>
          <button class="field-button" onclick="removeImplantation(${totalImplantation}, '${title}')" type="button">Remover</button>
        </div>
      `);

  totalImplantation++;

  implantations.push({
    id,
    title,
    image,
  });
};

const addCRMFromTo = (id = -1) => {
  const from = $("#crm-from").val();
  const to = $("#crm-to").val();

  $("#crm-list").append(`
        <div class="url-item" id="crm-item-${totalFromTo}">
          <span>${from} --> ${to}</span>
          <button class="field-button" onclick="removeFromTo(${totalFromTo}, '${from}', '${to}')" type="button">Remover</button>
        </div>
      `);

  totalFromTo++;
  fromTos.push({
    id,
    from: from,
    to: to,
  });
};

const removeFromTo = (fromto_index, from, to) => {
  $(`#crm-item-${fromto_index}`).remove();
  const arrIndex = fromTos.findIndex(
    (elem) => elem.from === from && elem.to === to
  );
  fromTos.splice(arrIndex, 1);
};

const removeBlueprint = (blueprint_index, title) => {
  $(`#blueprint-item-${blueprint_index}`).remove();
  const arrIndex = blueprints.findIndex((elem) => elem.title === title);
  blueprints.splice(arrIndex, 1);
};

const removeImplantation = (implantation_index, title) => {
  $(`#implantation-item-${implantation_index}`).remove();
  const arrIndex = implantations.findIndex((elem) => elem.title === title);
  implantations.splice(arrIndex, 1);
};

const addArea = (id = -1) => {
  const area = $("#area-name").val();

  if (area === "") return;

  $("#area-option").append(`
        <option value="${area}">${area}</option>
      `);

  totalAreas++;
  areas.push({
    id,
    title: area,
    items: [],
  });

  $("#area-name").val("");
};

const addAreaItem = (id = -1) => {
  const areaName = $("#area-option").val();
  const itemTitle = $("#area-title").val();
  const itemImage = $("#area-image").val();

  const areaIndex = areas.findIndex((elem) => elem.title === areaName);
  areas[areaIndex].items = [
    ...areas[areaIndex].items,
    {
      id,
      title: itemTitle,
      image: itemImage,
    },
  ];

  if ($(`#area-${removeSpaces(areaName)}-list`).length === 0) {
    $("#area-list").append(`
      <div class="area-wrapper" id="wrapper-${removeSpaces(areaName)}">
        <span>${areaName}</span>
        <div class="area-items-list" id="area-${removeSpaces(areaName)}-list">
          <div class="url-item" id="area-item-${removeSpaces(
            areaName
          )}-${removeSpaces(itemTitle)}">
            <span>${itemTitle}</span>
            <button class="field-button" onclick="removeAreaItem('${areaName}', '${itemTitle}')" type="button">Remover</button>
          </div>
        </div>
      </div>
    `);
  } else {
    $(`#area-${removeSpaces(areaName)}-list`).append(`
        <div class="url-item" id="area-item-${removeSpaces(
          areaName
        )}-${removeSpaces(itemTitle)}">
          <span>${itemTitle}</span>
          <button class="field-button" onclick="removeAreaItem('${areaName}', '${itemTitle}')" type="button">Remover</button>
        </div>
      `);
  }

  $("#area-title").val("");
  $("#area-image").val("");
};

const removeAreaItem = (areaName, itemTitle) => {
  $(`#area-item-${removeSpaces(areaName)}-${removeSpaces(itemTitle)}`).remove();
  const areaIndex = areas.findIndex((elem) => elem.title === areaName);
  const itemIndex = areas[areaIndex].items.findIndex(
    (elem) => elem.title === itemTitle
  );

  areas[areaIndex].items.splice(itemIndex, 1);

  if (areas[areaIndex].items.length === 0)
    $(`#wrapper-${removeSpaces(areaName)}`).remove();
};

const removeSpaces = (input) => {
  return input
    .replace(/[^a-zA-Z0-9 ]/g, "")
    .split(" ")
    .join("-");
};

const clearForm = () => {
  $("#project-id").val("");
  $("#project-name").val("");
  $("#video").val("");
  $("#chat-url").val("");
  $("#whatsapp").val("");
  $("#email").val("");
  $("#telefone").val("");
  $("#legal").val("");
  $("#adress_text").val("");
  $("#maps_link").val("");
  $("#crm-url").val("");
  $("#crm-produto").val("");
  $("#privacidade").val("");
  $("#intro-title").val("");
  $("#intro-body").val("");
  $("#intro-button").val("");
  $("#intro-url").val("");
  $("#view-title").val("");
  $("#view-image").val("");
  $("#view-desc").val("");
  $("#concept-title").val("");
  $("#concept-body").val("");
  $("#concept-image").val("");
  $("#more-1-title").val("");
  $("#more-1-body").val("");
  $("#more-1-button").val("");
  $("#more-1-url").val("");
  $("#more-1-positon").val(0);
  $("#more-2-title").val("");
  $("#more-2-body").val("");
  $("#more-2-button").val("");
  $("#more-2-url").val("");
  $("#more-2-positon").val(0);

  $("#bg_header").val("");
  $("#logo").val("");
  $("#bg_section_2").val("");
  $("#bg_video").val("");
  $("#bg_implementation").val("");
  $("#bg_differentials").val("");
  $("#form_key").val("");
  $("#recaptcha_key").val("");

  youtubeVideos = [];
  images = [];
  architects = [];
  implantations = [];
  blueprints = [];
  areas = [];
  fromTos = [];

  totalYoutubeVideos = 0;
  totalArchitects = 0;
  totalImages = 0;
  totalImplantation = 0;
  totalAreas = 0;
  totalFromTo = 0;
  totalBlueprints = 0;
};

const handleSubmit = () => {
  if (update) {
  } else {
    saveProject();
  }
};

const saveProject = async () => {
  const projectId = $("#project-id").val();
  const projectName = $("#project-name").val();
  const mainVideo = $("#video").val();
  const chatURL = $("#chat-url").val();
  const whatsapp = $("#whatsapp").val();
  const email = $("#email").val();
  const phone = $("#telefone").val();
  const crmURL = $("#crm-url").val();
  const crmProduto = $("#crm-produto").val();
  const politicaPrivacidade = $("#privacidade").val();

  const legal = $("#legal").val();
  const adress_text = $("#adress_text").val();
  const maps_link = $("#maps_link").val();

  const introTitle = $("#intro-title").val();
  const introBody = $("#intro-body").val();
  const introButton = $("#intro-button").val();
  const introButtonURL = $("#intro-url").val();
  const viewTitle = $("#view-title").val();
  const viewImage = $("#view-image").val();
  const viewDesc = $("#view-desc").val();
  const conceptTitle = $("#concept-title").val();
  const conceptBody = $("#concept-body").val();
  const conceptImage = $("#concept-image").val();
  const moreOneTitle = $("#more-1-title").val();
  const moreOneBody = $("#more-1-body").val();
  const moreOneButton = $("#more-1-button").val();
  const moreOneUrl = $("#more-1-url").val();
  const moreOnePosition = $("#more-1-positon").val();
  const moreTwoTitle = $("#more-2-title").val();
  const moreTwoBody = $("#more-2-body").val();
  const moreTwoButton = $("#more-2-button").val();
  const moreTwoUrl = $("#more-2-url").val();
  const moreTwoPosition = $("#more-2-positon").val();
  const bg_header = $("#bg_header").val();
  const logo = $("#logo").val();
  const bg_section_2 = $("#bg_section_2").val();
  const bg_video = $("#bg_video").val();
  const bg_implementation = $("#bg_implementation").val();
  const bg_differentials = $("#bg_differentials").val();
  const form_key = $("#form_key").val();
  const recaptcha_key = $("#recaptcha_key").val();

  const moreOneId = $("#more-1-id").val();
  const moreTwoId = $("#more-2-id").val();
  const introId = $("#intro-id").val();
  const viewId = $("#view-id").val();
  const conceptId = $("#concept-id").val();

  const data = {
    projectId,
    projectName,
    mainVideo,
    chatURL,
    whatsapp,
    email,
    phone,
    crmURL,
    crmProduto,
    politicaPrivacidade,
    bg_header,
    logo,
    bg_section_2,
    bg_video,
    bg_implementation,
    bg_differentials,
    form_key,
    recaptcha_key,
    introTitle,
    introBody,
    introButton,
    introButtonURL,
    viewTitle,
    viewImage,
    viewDesc,
    conceptTitle,
    conceptBody,
    conceptImage,
    moreOneTitle,
    moreOneBody,
    moreOneButton,
    moreOneUrl,
    moreOnePosition,
    moreTwoTitle,
    moreTwoBody,
    moreTwoButton,
    moreTwoUrl,
    moreTwoPosition,
    youtubeVideos,
    images,
    architects,
    implantations,
    areas,
    fromTos,
    blueprints,
    legal,
    adress_text,
    maps_link,
    moreOneId,
    moreTwoId,
    introId,
    viewId,
    conceptId,
  };

  $.ajax({
    method: "post",
    url: ipAjaxVar.ajaxurl,
    data: {
      action: update ? "update_project" : "save_project",
      idmop_project,
      data: data,
    },
  })
    .done(function (msg) {
      console.log(msg);
      alert("Projeto salvo com sucesso!");
      if (!update) clearForm();
    })
    .fail(function (xhr, status, error) {
      alert("Falha no cadastro, tente novamente.");
      console.log(xhr);
    });
};

$("#project-name").on("change", () => {
  $("#project-id").val(removeSpaces($("#project-name").val().toLowerCase()));
});

$(document).ready(async () => {
  var urlParams = new URLSearchParams(window.location.search);
  if (urlParams.has("updt")) {
    $("#form-container").prepend(`
      <div id="spinner-container" style="width: 100vw; height: 100vh; background-color: rgba(0,0,0,.7); display: flex; align-items: center; justify-content: center;position: fixed; overflow-y: scroll;top: 0; right: 0; bottom: 0; left: 0;"><div class="lds-ring"><div></div><div></div><div></div><div></div></div></div>
    `);
    const id = urlParams.get("updt");
    const data = await $.ajax({
      method: "GET",
      url: ipAjaxVar.ajaxurl,
      data: {
        action: "load_project",
        projectId: id,
      },
    });
    const project = JSON.parse(data);
    associateData(project);
    update = true;
    idmop_project = id;
    $("#spinner-container").remove();
  }
});

const associateData = (project) => {
  $("#project-id").val(project.codename);
  $("#project-name").val(project.name);
  $("#video").val(project.video);
  $("#chat-url").val(project.chat);
  $("#whatsapp").val(project.whatsapp);
  $("#email").val(project.email);
  $("#telefone").val(project.phone);
  $("#crm-url").val(project.crm_url);
  $("#crm-produto").val(project.crm_id);
  $("#privacidade").val(project.privacy_url);
  $("#intro-title").val(project.introduction.title);
  $("#intro-body").val(project.introduction.body);
  $("#intro-button").val(project.introduction.button);
  $("#intro-url").val(project.introduction.action);
  $("#view-title").val(project.view.title);
  $("#view-image").val(project.view.image);
  $("#view-desc").val(project.view.desc);
  $("#concept-title").val(project.concept.title);
  $("#concept-body").val(project.concept.body);
  $("#concept-image").val(project.concept.image);
  $("#more-1-title").val(project.knowMoreButtons.items[0].title);
  $("#more-1-body").val(project.knowMoreButtons.items[0].body);
  $("#more-1-button").val(project.knowMoreButtons.items[0].button);
  $("#more-1-url").val(project.knowMoreButtons.items[0].link);
  $("#more-1-positon").val(project.knowMoreButtons.items[0].position);
  $("#more-2-title").val(project.knowMoreButtons.items[1].title);
  $("#more-2-body").val(project.knowMoreButtons.items[1].body);
  $("#more-2-button").val(project.knowMoreButtons.items[1].button);
  $("#more-2-url").val(project.knowMoreButtons.items[1].link);
  $("#more-2-positon").val(project.knowMoreButtons.items[1].position);
  $("#bg_header").val(project.bg_header);
  $("#logo").val(project.logo);
  $("#bg_section_2").val(project.bg_section_2);
  $("#bg_video").val(project.bg_video);
  $("#bg_implementation").val(project.bg_implementation);
  $("#bg_differentials").val(project.bg_differentials);
  $("#form_key").val(project.form_key);
  $("#recaptcha_key").val(project.recaptcha_key);
  $("#legal").val(project.legal);
  $("#adress_text").val(project.adress_text);
  $("#maps_link").val(project.maps_link);

  $("#more-1-id").val(project.knowMoreButtons.items[0].idmop_more);
  $("#more-2-id").val(project.knowMoreButtons.items[1].idmop_more);
  $("#intro-id").val(project.introduction.idmop_intro);
  $("#view-id").val(project.view.idmop_view);
  $("#concept-id").val(project.concept.idmop_concept);

  for (const crm_conv of project.crm_convertion.items) {
    $("#crm-list").append(`
        <div class="url-item" id="crm-item-${totalFromTo}">
          <span>${crm_conv.from} --> ${crm_conv.to}</span>
          <button class="field-button" onclick="removeFromTo(${totalFromTo}, '${crm_conv.from}', '${crm_conv.to}')" type="button">Remover</button>
        </div>
      `);

    totalFromTo++;
    fromTos.push({
      id: crm_conv.idmop_crm_from_to,
      from: crm_conv.from,
      to: crm_conv.to,
    });
  }

  for (const video of project.videoGallery.items) {
    $("#youtube-list").append(`
        <div class="url-item" id="yt-video-${totalYoutubeVideos}">
          <span>${video.link}</span>
          <button class="field-button" onclick="removeYoutubeVideo(${totalYoutubeVideos}, '${video.link}')" type="button">Remover</button>
        </div>
      `);

    youtubeVideos.push({
      id: video.idmop_video,
      url: video.link,
      preview: video.preview,
    });
    totalYoutubeVideos++;
  }

  for (const architect of project.architects.items) {
    $("#architect-list").append(`
        <div class="url-item" id="architect-item-${totalArchitects}">
          <span>${architect.title}</span>
          <button class="field-button" onclick="removeArchitect(${totalArchitects}, '${architect.title}')" type="button">Remover</button>
        </div>
      `);

    totalArchitects++;

    architects.push({
      id: architect.idmop_architect,
      name: architect.title,
      body: architect.body,
      image: architect.image,
    });
  }

  for (const image of project.imageGallery.items) {
    $("#image-list").append(`
        <div class="url-item" id="image-${totalImages}">
          <span>${image.image.replace("https://www.", "")}</span>
          <button class="field-button" onclick="removeImageFromGallery(${totalImages}, '${
      image.image
    }')" type="button">Remover</button>
        </div>
      `);

    $("#gallery-of-images-url").val("");
    images.push({
      id: image.idmop_image,
      url: image.image,
      title: image.title,
    });
    totalImages++;
  }

  for (const implementation of project.implementation.items) {
    $("#implantation-list").append(`
        <div class="url-item" id="implantation-item-${totalImplantation}">
          <span>${implementation.title}</span>
          <button class="field-button" onclick="removeImplantation(${totalImplantation}, '${implementation.title}')" type="button">Remover</button>
        </div>
      `);

    totalImplantation++;

    implantations.push({
      id: implementation.idmop_implementation,
      title: implementation.title,
      image: implementation.image,
    });
  }

  for (const blueprint of project.blueprints.items) {
    $("#blueprint-list").append(`
        <div class="url-item" id="blueprint-item-${totalBlueprints}">
          <span>${blueprint.title}</span>
          <button class="field-button" onclick="removeBlueprint(${totalBlueprints}, '${blueprint.title}')" type="button">Remover</button>
        </div>
      `);

    totalBlueprints++;

    blueprints.push({
      id: blueprint.idmop_blueprint,
      title: blueprint.title,
      image: blueprint.image,
    });
  }

  for (const area of project.differentials.items) {
    $("#area-option").append(`
        <option value="${area.title}">${area.title}</option>
      `);

    totalAreas++;
    areas.push({
      id: area.idmop_differential,
      title: area.title,
      items: [],
    });

    for (const areaItem of area.items) {
      const areaIndex = areas.findIndex((elem) => elem.title === area.title);
      areas[areaIndex].items = [
        ...areas[areaIndex].items,
        {
          id: areaItem.idmop_area_item,
          title: areaItem.title,
          image: areaItem.image,
        },
      ];

      if ($(`#area-${removeSpaces(area.title)}-list`).length === 0) {
        $("#area-list").append(`
      <div class="area-wrapper" id="wrapper-${removeSpaces(area.title)}">
        <span>${area.title}</span>
        <div class="area-items-list" id="area-${removeSpaces(area.title)}-list">
          <div class="url-item" id="area-item-${removeSpaces(
            area.title
          )}-${removeSpaces(areaItem.title)}">
            <span>${areaItem.title}</span>
            <button class="field-button" onclick="removeAreaItem('${
              area.title
            }', '${areaItem.title}')" type="button">Remover</button>
          </div>
        </div>
      </div>
    `);
      } else {
        $(`#area-${removeSpaces(area.title)}-list`).append(`
        <div class="url-item" id="area-item-${removeSpaces(
          area.title
        )}-${removeSpaces(areaItem.title)}">
          <span>${areaItem.title}</span>
          <button class="field-button" onclick="removeAreaItem('${
            area.title
          }', '${areaItem.title}')" type="button">Remover</button>
        </div>
      `);
      }
    }
  }
};
