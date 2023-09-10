import { v4 as uuidv4 } from "uuid";
let users = [];

//@ route GET
//@access Public
//@desc Returning users collection
export const getUsers = (req, res) => {
  res.status(200).json(users);
};

//@ route GET
//@access Public
//@desc getting a single user from db
export const getUser = (req, res) => {
  const { id } = req.params;

  const foundUser = users.filter((user) => user.id === id);
  res.json(foundUser);
};

//@ route POST
//@access Public
//@desc Create user
export const createUser = (req, res) => {
  const user = req.body;
  users.push({ ...user, id: uuidv4() });
  res.status(200).json(`user with id ${user.id} created`);
};

//@ route PUT
//@access Public
//@desc update user
export const updateUser = (req, res) => {
  const { id } = req.params;
  const { email, firstName, lastName } = req.body;
  const user = users.find((user) => user.id === id);

  if (email) user.email = email;
  if (firstName) user.firstName = firstName;
  if (lastName) user.lastName = lastName;

  res.status(200).json(`User with id ${id} updated successfully`);
};

//@ route Delete
//@access Public
//@desc Delete user
export const deleteUser = (req, res) => {
  const { id } = req.params;
  users = users.filter((user) => user.id === id);
  res.status(200).json({ message: "delete user" });
};
