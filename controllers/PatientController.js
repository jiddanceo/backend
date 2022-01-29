const Patient = require('../models/Patient');

class PatientController {
    index(req, res) {
        Patient.all((patient) => {
            if (patient.length > 0) {
                const data = {
                    message: 'Menampilkan semua Patient',
                    data: patient,
                };

                return res.status(200).json(data);
            }

            const data = {
                message: 'Patient is empty',
            };
            res.status(200).json(data);
        });
    }

    async store(req, res) {
        // TODO : refactor to get data from db
        const { id, name, phone, address, status, in_date_at, out_date_at } = req.body;

        if (!id || !name || !phone || !address || !status || !in_date_at || !out_date_at) {
            const data = {
                message: 'Semua Data Harus Di Kirim ',
            };

            return res.status(422).json(data);
        }

        const result = await Patient.create(req.body);

        const data = {
            message: `Menambahkan Data Patient`,
            data: result,
        };

        return res.status(201).json(data);
    }

    async update(req, res) {
        const { id } = req.params;
        const patient = await Patient.find(id);

        if (patient) {
            const patient = await Patient.update(id, req.body);
            const data = {
                message: 'Mengedit Data Patient',
                data: patient,
            };
            res.status(200).json(data);

        } else {
            const data = {
                message: 'Patient Not Found',
            };
            res.status(404).json(data);
        }
    }

    async destroy(req, res) {
        const { id } = req.params;
        const patient = await Patient.find(id);

        if (patient) {
            await Patient.delete(id);
            const data = {
                message: 'Menghapus Data Patient',
            };
            res.status(200).json(data);
        } else {
            const data = {
                message: 'Patient not found',
            };
            res.status(404).json(data);
        }
    }

    async show(req, res) {
        const { id } = req.params;
        const patient = await Patient.find(id);

        if (patient) {
            const data = {
                message: 'Menampilkan Detail Patient',
                data: patient,
            };
            res.status(200).json(data);
        } else {
            const data = {
                message: 'Patient not found',
            };
            res.status(404).json(data);
        }
    }
}

const patientcontroller = new PatientController();

module.exports = patientcontroller;