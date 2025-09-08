// data.js
const productData = {
    specifications: {
        "Mitsubishi Triton 2025": {
            basic: {
                engineType: "2.4L MIVEC Turbo Diesel",
                displacement: "2,442 cc",
                transmission: "Số tự động 6 cấp",
                dimensions: "5,305 x 1,815 x 1,795 mm",
                weight: "1,955 kg"
            },
            performance: {
                maxPower: "181 mã lực tại 3,500 vòng/phút",
                maxTorque: "430 Nm tại 2,500 vòng/phút",
                topSpeed: "180 km/h",
                fuelConsumption: "7.6L/100km (kết hợp)"
            },
            safety: {
                brakeSystem: "Đĩa trước/sau",
                tractionControl: "Có (TCL)",
                airbags: "7 túi khí",
                supportSystems: "ASC, HSA, ESS"
            }
        }
    },
    costEstimates: {
        basePriceRange: "700 - 900 triệu VND",
        regions: [
            { name: "Hà Nội", registrationFee: 20000000, insuranceFee: 15000000, negotiablePrice: 5000000 },
            { name: "TP.HCM", registrationFee: 25000000, insuranceFee: 18000000, negotiablePrice: 7000000 },
            { name: "Đà Nẵng", registrationFee: 18000000, insuranceFee: 12000000, negotiablePrice: 4000000 },
            { name: "Cần Thơ", registrationFee: 17000000, insuranceFee: 11000000, negotiablePrice: 3500000 }
        ]
    }
};

export { productData };