// TODO 2: SETUP ROUTING (ROUTER)
const PatientController = require('../controllers/PatientController.js');
const express = require('express');

const router = express.Router();

router.get('/', (req, res) => {
  res.send('Hello express');
});

router.get('/patient', PatientController.index);
router.post('/patient', PatientController.store);
router.put('/patient/:id', PatientController.update);
router.delete('/patient/:id', PatientController.destroy);

module.exports = router;