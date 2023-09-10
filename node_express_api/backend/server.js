import express from "express";
import dotenv from "dotenv";
import bodyParser from "body-parser";
import colors from "colors";
import userRoutes from "./router/users.js";

dotenv.config();
const PORT = 4000 || process.env.PORT;
const app = express();

app.use(bodyParser.json());
app.use("/users", userRoutes);

app.get("/", (req, res) => {
  res.send({ message: "Homepage" });
});

app.listen(PORT, () =>
  console.log(`App running on port http://localhost:${PORT}`.cyan.underline)
);
