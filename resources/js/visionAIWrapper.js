window.sendDataToVAI = function (index, textArrays) {
  // TO BE FIXED BY OAUTH2 FOR CORS
  // axios({
  //   'async': true,
  //   'crossDomain': true,
  //   'url': 'https://vision.googleapis.com/v1p4beta1/images:annotate?key=AIzaSyAkQWEhAYzDFByr28nuOhf_absH8MfmArQ',
  //   'method': 'POST',
  //   'headers': {
  //     'Content-Type': 'application/json',
  //     'User-Agent': 'PostmanRuntime/7.11.0',
  //     'Accept': '*/*',
  //     'Cache-Control': 'no-cache',
  //     'Postman-Token': 'df32e39a-3e30-41a6-8962-b17cf90d625d,8319ec30-33e0-48ad-8463-531860b031de',
  //     'Host': 'vision.googleapis.com',
  //     'accept-encoding': 'gzip, deflate',
  //     'content-length': '311',
  //     'Connection': 'keep-alive',
  //     'cache-control': 'no-cache'
  //   },
  //   'processData': false,
  //   'data': '{\n  "requests": [\n    {\n      "image": {\n        "source": {\n          "imageUri": "http://abullseyeview.s3.amazonaws.com/wp-content/uploads/Screen-shot-2012-10-29-at-8.28.31-AM-e1351514291477.png"\n        }\n      },\n      "features": [\n        {\n          "type": "TEXT_DETECTION"\n        }\n      ]\n    }\n  ]\n}'
  // })
  //   .then((response) => {
  //     console.log(response)
  //   })

  const nameTags = ['0mg', '0g', '0cg']
  const frequencyTags = ['times', 'days', 'day', 'daily', 'weekly', 'hours', 'hour']

  let qty = ''
  let frequency = ''
  let name = ''
  let quantity_amount = ''
  let quantity_type = ''

  const formattedText = textArrays[index].text.toLowerCase().split('\n')

  // VERY SIMPLE PROCESSING, NEEDS TO BE MORE ROBUST
  formattedText.forEach(elem => {
    nameTags.forEach((nameTag) => {
      if (elem.indexOf(nameTag) !== -1) {
        name = elem
        return
      }
    })

    if (elem.split(' ')[0] === 'take') {
      quantity_amount = elem.split(' ')[1]
      quantity_type = elem.split(' ')[2]
    }

    for (let i = 0; i < frequencyTags.length; i++) {
      if (elem.indexOf(frequencyTags[i]) !== -1) {
        let formattedELem = elem.replace('mouth', '').replace('by', '')
        frequency += ` ${formattedELem}`
        return
      }
    }

    elem.indexOf('qty') !== -1 ? qty = elem.replace(':', '').replace(' ', '').replace('qty', '') : ''
  })

  frequency = frequency.replace(/\s\s+/g, '')

  return axios(
    {
      method: 'post',
      url: '/medications',
      data: {
        frequency: frequency,
        name: name,
        qty: qty,
        quantity_type: quantity_type,
        quantity_amount: quantity_amount
      }
    }
  )
}
